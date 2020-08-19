<?php
namespace Tigren\DailyDeal\Plugin\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Tigren\DailyDeal\Model\ResourceModel\Posts\CollectionFactory;
use Magento\Framework\Exception\LocalizedException;

class CheckQty
{
    protected $collection;
    protected $scopeConfig;
    public  function  __construct(CollectionFactory $collection,ScopeConfigInterface $scopeConfig)
    {
        $this->collection =$collection;
        $this->scopeConfig = $scopeConfig;
    }
    public function beforeAddProduct(\Magento\Checkout\Model\Cart $subject, $productInfo, $requestInfo = null)
    {
        $enable = $this->scopeConfig->getValue("example/general/enable");
        $items = $subject->getQuote()->getAllItems();
        $Sku = $productInfo->getSku();
        $myTable = $this->collection->create();
        $mySku = [];
        foreach ($myTable as $product)
        {
            $mySku[] = $product->getData('sku');
        }
        foreach($items as $item )
        {
            $sku[] = $item->getSku();
        }
        if (in_array($Sku,$sku))
        {
            $itemQty = $item->getQty();
            $qty = $myTable->getItemByColumnValue('sku',$Sku)->getData('quantity');
            $timeStart = $myTable->getItemByColumnValue('sku', $Sku)->getData('start_time');
            $timeEnd = $myTable->getItemByColumnValue('sku', $Sku)->getData('end_time');
            $status = $myTable->getItemByColumnValue('sku', $Sku)->getData('status');
            $now = date('Y-m-d H:i:s');
            if ($itemQty >= $qty && $timeStart <= $now && $timeEnd >= $now && $status == 1 && $enable == 1)
            {
                throw new LocalizedException(__('can only add maximum %1 Product to Cart',$qty));
            }
            else {
                return [$productInfo, $requestInfo];
            }
        }
        if (in_array($Sku,$mySku))
        {
            $timeStart = $myTable->getItemByColumnValue('sku', $Sku)->getData('start_time');
            $timeEnd = $myTable->getItemByColumnValue('sku', $Sku)->getData('end_time');
            $status = $myTable->getItemByColumnValue('sku', $Sku)->getData('status');
            $now = date('Y-m-d H:i:s');
            $qty = $myTable->getItemByColumnValue('sku',$Sku)->getData('quantity');
            if ($requestInfo['qty'] > $qty  && $timeStart <= $now && $timeEnd >= $now && $status == 1 && $enable == 1)
            {
                throw new LocalizedException(__('can only add maximum %1 Product to Cart',$qty));
            }
            else {
                return [$productInfo, $requestInfo];
            }
        }
        return [$productInfo, $requestInfo];
    }
}

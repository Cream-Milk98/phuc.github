<?php
namespace Tigren\DailyDeal\Plugin\Model;

use Tigren\DailyDeal\Model\ResourceModel\Posts\CollectionFactory;
use Magento\Framework\Exception\LocalizedException;

class CheckQty
{
    protected $collection;
    public  function  __construct(CollectionFactory $collection )
    {
        $this->collection =$collection;
    }
    public function beforeAddProduct(\Magento\Checkout\Model\Cart $subject, $productInfo, $requestInfo = null)
    {
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
            $sku = $item->getSku();
            if (in_array($sku,$mySku))
            {
                $itemQty = $item->getQty();
                $qty = $myTable->getItemByColumnValue('sku',$Sku)->getData('quantity');
                if ($itemQty >= $qty)
                {
                    throw new LocalizedException(__('can only add maximum %1 Product to Cart',$qty));
                }
            }

        }
        if (in_array($Sku,$mySku))
        {
            $qty = $myTable->getItemByColumnValue('sku',$Sku)->getData('quantity');
            if ($requestInfo['qty'] > $qty)
            {
                throw new LocalizedException(__('can only add maximum %1 Product to Cart',$qty));
            }
        }
        return [$productInfo, $requestInfo];
    }
}

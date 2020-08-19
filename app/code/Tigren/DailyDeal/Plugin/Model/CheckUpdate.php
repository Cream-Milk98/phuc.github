<?php

namespace Tigren\DailyDeal\Plugin\Model;

use Magento\Framework\Exception\LocalizedException;
use Tigren\DailyDeal\Model\ResourceModel\Posts\CollectionFactory;

use Magento\Checkout\Model\Cart;
class CheckUpdate
{

    protected $collection;
    public  function  __construct(CollectionFactory $collection)
    {
        $this->collection =$collection;
    }

    public function beforeupdateItems(Cart $subject,$data)
    {
        $quote = $subject->getQuote()->getAllItems();
        $myTable = $this->collection->create();
        $mySku = [];
        foreach ($myTable as $product)
        {
            $mySku[] = $product->getData('sku');
            var_dump($mySku);exit;
        }
        foreach ($quote as $item)
        {
            if (in_array($item->getSku(),$mySku))
            {
                $myQty = $myTable->getItemByColumnValue('sku',$item->getSku())->getData('quantity');
                $id = $item->getId();

                if ($data['qty'] > $myQty)
                {
                    throw new LocalizedException(__('can only add maximum <?= $qty ?> Product to Cart'));
                }
            }
        }
        return [$data];

    }
}

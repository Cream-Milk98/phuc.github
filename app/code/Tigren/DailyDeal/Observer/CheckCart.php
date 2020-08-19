<?php

namespace Tigren\DailyDeal\Observer;

use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Tigren\DailyDeal\Model\ResourceModel\Posts\CollectionFactory;
use Magento\Checkout\Model\Cart;

class CheckCart implements ObserverInterface
{
    protected $cart;
    protected $collection;
    protected $productFactory;
    protected $scopeConfig;

    public function __construct(
        Cart $cart,
        CollectionFactory $collection,
        ProductFactory $productFactory,
        ScopeConfigInterface $scopeConfig
    )
    {
        $this->cart = $cart;
        $this->productFactory = $productFactory;
        $this->scopeConfig = $scopeConfig;
        $this->collection = $collection;
    }

    public function execute(Observer $observer)
    {
        //        Get Value General Configuration
        $enable = $this->scopeConfig->getValue("example/general/enable");

        $quote_item = $this->cart->getQuote()->getAllItems();
        $myTable = $this->collection->create();
        $productFactory = $this->productFactory->create();
        $productSku = [];
        foreach ($myTable as $product) {
            $productSku[] = $product->getData('sku');
        }
        foreach ($quote_item as $item) {
            $itemSku = $item->getSku();
            if (in_array($itemSku, $productSku)) {
                $timeStart = $myTable->getItemByColumnValue('sku', $itemSku)->getData('start_time');
                $timeEnd = $myTable->getItemByColumnValue('sku', $itemSku)->getData('end_time');
                $status = $myTable->getItemByColumnValue('sku', $itemSku)->getData('status');
                $now = date('Y-m-d H:i:s');
                if ($timeStart <= $now && $timeEnd >= $now && $status == 1 && $enable == 1) {
                    $price = $myTable->getItemByColumnValue('sku', $itemSku)->getData('price_deals');
//                    die('124');
                    $item->setCustomPrice($price);
                    $item->setOriginalCustomPrice($price);
                } else {
                    $price = $productFactory->loadByAttribute('sku', $item->getSku())->GetPrice();
                    $item->setCustomPrice($price);
                    $item->setOriginalCustomPrice($price);
                }
                $item->getProduct()->setIsSuperMode(true);
                $item->save();
            }
        }
        return $this->cart->getQuote()->collectTotals()->save();
    }
}


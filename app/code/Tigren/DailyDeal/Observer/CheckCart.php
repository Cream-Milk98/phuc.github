<?php

namespace Tigren\DailyDeal\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
class CheckCart implements ObserverInterface
{

    public function execute(\Magento\Framework\Event\Observer $observer) {
        $request = $observer->getEvent()->getRequest();
        $productPrice = $request->getParam('price');
        var_dump($productPrice);exit;
    }

}

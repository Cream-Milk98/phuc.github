<?php

namespace Business\Clothes\Observer;

use Magento\Framework\View\LayoutInterface;

class EventsOne implements \Magento\Framework\Event\ObserverInterface
{
    protected $layout;

    public function __construct(\Magento\Framework\View\LayoutInterface $layout)
    {
        $this->layout = $layout;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $transportObject = $observer->getEvent()->getData('transportObject');
        if ($transportObject) {
            $textLinkHtml = $this->layout->createBlock(
                'Magento\Framework\View\Element\Template')->setTemplate('Business_Clothes::addmenu.phtml')->toHtml();
            $topmenuHtml = $transportObject->getHtml() . $textLinkHtml;
            $transportObject->setHtml($topmenuHtml);
        }
        return $this;
    }
}

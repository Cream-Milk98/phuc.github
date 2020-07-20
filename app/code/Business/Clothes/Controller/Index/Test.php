<?php

namespace Business\Clothes\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{

    public function execute()
    {
        $textDisplay = new \Magento\Framework\DataObject(array('text' => 'Events'));
        $this->_eventManager->dispatch('Business_Clothes_events_test', ['mp_text' => $textDisplay]);
        echo $textDisplay->getText();
        exit;
    }
}

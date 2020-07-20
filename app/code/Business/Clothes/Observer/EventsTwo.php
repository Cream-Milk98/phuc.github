<?php

namespace Business\Clothes\Observer;
class EventsTwo implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    { 
    	    $product = $observer->getProduct();
	        $originalName = $product->getName();
			if (!empty($product->getCustomAttribute('is_special'))) {
		        if ($product->getCustomAttribute('is_special')->getValue() == 'Thuộc tính'){
		                // $result = $result . ' - Special Promotion';
		        $modifiedName = $originalName.' - Hot Sale';
		        $product->setName($modifiedName);
		        }
		    }
  

    }

}

<?php

namespace Business\Shoes\Plugin\Checkout\Model;


use Magento\Framework\Exception\LocalizedException;
/**
 * 
 */
class Cart
{
	
	public function beforeAddProduct(
		\Magento\Checkout\Model\Cart $subject,
		$productInfo,
		$requestInfo = null
	)
	{
			if (!empty($productInfo->getCustomAttribute('is_special'))) 
			{
				$productId = $productInfo->getId();
        		$items = $subject->getQuote()->getAllItems();
        		$att =$productInfo->getCustomAttribute('is_special')->getValue();
				if ($att == 'Thuộc tính') 
				{
					$cart_id = [];
					$cart_att = [];
	        		foreach($items as $item) 
	        		{
					$cart_id[] = $item->getProductId();
					$cart_att[] = $item->getProduct()->getIsSpecial();				    
					}
					
	            	if(!empty($cart_att))
	            	{
	            		if (!in_array($productId, $cart_id))
	            		{
	            			 $this->_checkoutSession->setUseNotice(false);
	            		}
	            		else
	            		{
	            			 return array($productInfo, $requestInfo);
	            		}
	            	}
				}
			
			}
			else 
			{
            	return array($productInfo, $requestInfo);
        	}
	
    } 
}
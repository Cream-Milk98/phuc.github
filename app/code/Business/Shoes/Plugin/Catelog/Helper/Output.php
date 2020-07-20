<?php

namespace Business\Shoes\Plugin\Catelog\Helper;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Config;
use Magento\Framework\UrlInterface;

class Output
{
    protected $_eavConfig;
    protected $_urlInterface;

    public function __construct(Config $eavConfig, UrlInterface $urlInterface)
    {
        $this->_eavConfig = $eavConfig;
        $this->_urlInterface = $urlInterface;
    }

    public function aroundProductAttribute(\Magento\Catalog\Helper\Output $output, callable $proceed, Product $product, $attributeHtml, $attributeName)
    {
        $result = $proceed($product, $attributeHtml, $attributeName);

        $attribute = $this->_eavConfig->getAttribute(\Magento\Catalog\Model\Product::ENTITY, $attributeName);


        if ($attribute && $attribute->getId() &&
            ($attribute->getAttributeCode() == 'description' || $attribute->getAttributeCode() == 'sort_description'))
        {
            $textLink = 'Gray';
            $textLinkUrl = $this->_urlInterface->getUrl('catalogsearch/result', ['q' => $textLink]);
            $result = preg_replace('/'.$textLink.'/i', '<a href="'. $textLinkUrl .'"><b>'. $textLink .'</b></a>', $result);
        }
        return $result;
    }

}

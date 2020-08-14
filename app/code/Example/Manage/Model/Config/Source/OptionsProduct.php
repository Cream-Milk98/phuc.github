<?php

namespace Example\Manage\Model\Config\Source;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollection;

use Magento\Framework\Option\ArrayInterface;
use Magento\Catalog\Model\ProductRepository;
use Example\Manage\Model\ResourceModel\Posts\CollectionFactory as DealsCollection;

class OptionsProduct implements ArrayInterface
{
    protected $options;
    protected $_respository;
    protected $_productFactory;
    protected $_dealFactory;

    public function __construct(
        ProductCollection $productFactory,
        ProductRepository $productRepository,
        DealsCollection $dealFactory
    )
    {
        $this->_productFactory = $productFactory;
        $this->_respository = $productRepository;
        $this->_dealFactory = $dealFactory;
    }

    public function getProductBySku($sku)
    {
        return $this->_respository->get($sku);
    }

    public function toOptionArray()
    {
        $options[] = array('label' => '--- Product List ---');;
        $products = $this->_productFactory->create();
        if ($products->getSize()) {
            foreach ($products as $product) {
                $prod = $this->getProductBySku($product->getData('sku'))->getName();
                $sku =  $product->getData('sku');
                $options[] = array('value' => $sku, 'label' => $prod);
            }
        }
        return $options;
    }

}

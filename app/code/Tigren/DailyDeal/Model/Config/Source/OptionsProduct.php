<?php

namespace Tigren\DailyDeal\Model\Config\Source;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

use Magento\Framework\Option\ArrayInterface;
use Magento\Catalog\Model\ProductRepository;

class OptionsProduct implements ArrayInterface
{
    protected $options;
    protected $_respository;
    protected $collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory,
        ProductRepository $productRepository
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->_respository = $productRepository;
    }

    public function getProductBySku($sku)
    {
        return $this->_respository->get($sku);
    }

    public function toOptionArray()
    {
        $options[] = array('label' => '--- Product List ---');
//        Get Information Product in Magento
        $products = $this->collectionFactory->create();
        if ($products->getSize()) {
            foreach ($products as $product) {
                $prod = $this->getProductBySku($product->getData('sku'))->getName();
                $sku =  $product->getData('sku');
//                Customer Select
                $options[] = array('value' => $sku, 'label' => $prod);
            }
        }
        return $options;
    }

}

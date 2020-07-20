<?php

namespace Business\Clothes\Block;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ProductRepository;

class Display extends Template
{
    protected $collectionFactory;
    protected $productRepository;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        ProductRepository $productRepository
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->productRepository = $productRepository;
        parent::__construct($context);
    }
    public function displayProductbyIsSpecial()
    {
        return $this->collectionFactory->create()->addAttributeToFilter('is_special','Thuộc tính');
    }
    public function getProductBySku($sku)
    {
        return $this->productRepository->get($sku);
    }
}
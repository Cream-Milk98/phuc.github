<?php

namespace Tigren\DailyDeal\Ui\Listing\Columns;

use Magento\Catalog\Model\ProductRepository;

use Magento\Framework\Option\ArrayInterface;
use Tigren\DailyDeal\Model\ResourceModel\Posts\CollectionFactory;

class ShowNameBySku implements ArrayInterface
{
    protected $options;
    protected $productRepository;
    protected $collectionFactory;

    public function __construct(
        ProductRepository $productRepository,
        CollectionFactory $collectionFactory
    )
    {
        $this->productRepository = $productRepository;
        $this->collectionFactory = $collectionFactory;
    }
    public function getProductBySku($sku)
    {
        return $this->productRepository->get($sku);
    }

    public function toOptionArray()
    {
        $myTable = $this->collectionFactory->create();
        foreach ($myTable as $product) {
            $sk = $product->getData('sku');
            $prod = $this->getProductBySku($sk)->getName();
            $options[] = array('value' => $sk, 'label' => $prod);
        }
        return $options;
    }

}

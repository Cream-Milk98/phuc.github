<?php

namespace Example\Manage\Plugin\Model;

use Magento\Framework\View\Element\Template;
use Example\Manage\Model\ResourceModel\Posts\CollectionFactory;
use \Magento\Catalog\Model\ProductRepository;

class Product extends Template
{
    protected $collectionFactory;
    protected $productRepository;
    protected $scopeConfig;

    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        ProductRepository $productRepository,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->productRepository = $productRepository;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        $enable = $this->scopeConfig->getValue("example/general/enable");
        $deals = $this->collectionFactory->create();
        $dealSku = [];
        foreach ($deals as $deal) {
            $dealSku[] = $deal->getData('sku');
        }

        $id = $subject->getId();
//        Lấy ra id sản phẩm chính
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $parentId = $objectManager->create('Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable')->getParentIdsByChild($id);
//        lấy ra sku chính
        if (isset($parentId[0])) {
            $Sku = $this->productRepository->getById($parentId[0])->getSku();
        } else {
            $Sku = $subject->getSku();
        }

        if (in_array($Sku, $dealSku)) {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $endTime = $deals->getItemByColumnValue('sku', $Sku)->getData('end_time');
            $startTime = $deals->getItemByColumnValue('sku', $Sku)->getData('start_time');
            $now = date('Y-m-d H:i:s');
            $status = $deals->getItemByColumnValue('sku', $Sku)->getData('status');
//            var_dump($now <= $endTime);
            if ($now <= $endTime && $status == 1 && $now >= $startTime && $enable == 1) {
                return $result = $deals->getItemByColumnValue('sku', $Sku)->getData('price_deals');
            } else {
                return $result;
            }
        } else {
            return $result;
        }
    }
}

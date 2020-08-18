<?php

namespace Tigren\DailyDeal\Plugin\Model;

use Magento\Framework\View\Element\Template;
use Tigren\DailyDeal\Model\ResourceModel\Posts\CollectionFactory;
use Magento\Catalog\Model\ProductRepository;

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
//        Get Value General Configuration
        $enable = $this->scopeConfig->getValue("example/general/enable");
//        Information MyProduct in MyTable
        $deals = $this->collectionFactory->create();
//        Array Value Sku in MyTable
        $dealSku = [];
        foreach ($deals as $deal) {
            $dealSku[] = $deal->getData('sku');
        }

        $id = $subject->getId();
//       Get Value Id Product Main
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $parentId = $objectManager->create('Magento\ConfigurableProduct\Model\ResourceModel\Product\Type\Configurable')->getParentIdsByChild($id);
//        Get Value Sku Main
        if (isset($parentId[0])) {
            $Sku = $this->productRepository->getById($parentId[0])->getSku();
        } else {
            $Sku = $subject->getSku();
        }

        if (in_array($Sku, $dealSku)) {

//            Get Value Time
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $endTime = $deals->getItemByColumnValue('sku', $Sku)->getData('end_time');
            $startTime = $deals->getItemByColumnValue('sku', $Sku)->getData('start_time');
//           Get Now Date
            $now = date('Y-m-d H:i:s');
//            Get Value Status
            $status = $deals->getItemByColumnValue('sku', $Sku)->getData('status');
//            Condition return Sale price
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

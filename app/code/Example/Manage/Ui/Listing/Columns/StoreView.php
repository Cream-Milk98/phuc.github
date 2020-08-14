<?php

namespace Example\Manage\Ui\Listing\Columns;

use Magento\Store\Model\System\Store as SystemStore;

use Magento\Framework\Option\ArrayInterface;
use Example\Manage\Model\ResourceModel\Posts\CollectionFactory;

class StoreView implements ArrayInterface
{
    protected $options;
    protected $systemStore;
    protected $collectionFactory;

    public function __construct(
        SystemStore $systemStore,
        CollectionFactory $collectionFactory
    )
    {
        $this->systemStore = $systemStore;
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $options[]  = array('value' => 0, 'label' => __('All Store Views'));
        $myTable = $this->collectionFactory->create();
        $stores = $this->systemStore->getStoreCollection();
        $storeId = [];
        foreach ($myTable as $my) {
            $storeId[] = $my->getData('store_view');
        }
        foreach ($stores as $store) {
            if (in_array($store->getId(),$storeId)){
                $id = $store->getId();
                $storeName = $store->getName();
                $options[] = array('value' => $id, 'label' => $storeName);
            }
        }
        return $options;
    }

}

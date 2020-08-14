<?php

namespace Example\Manage\Model\Config\Source;
use Magento\Store\Model\System\Store as SystemStore;
use Magento\Framework\Option\ArrayInterface;

class OptionsStores implements ArrayInterface
{
    protected $systemStore;

    public function __construct(
        SystemStore $systemStore
    )
    {
        $this->systemStore = $systemStore;
    }
    public function toOptionArray()
    {
        $options[] = array('value' => 0, 'label' => __('All Store Views'));
        $options[] = array('label' => __('Main Website'));
        $options[] = array('label' => __('Main Website Store'));
        $store = $this->systemStore->getStoreCollection();
        foreach ($store as $key => $value) {
            $storeId = $value->getId();
            $storeName = $value->getName();
            $options[] = array('value' => $storeId, 'label' => $storeName);
        }
        return $options;
    }

}

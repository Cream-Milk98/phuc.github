<?php

namespace Example\Manage\Model\ResourceModel\Posts;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'product_daily_deals';
    protected $_eventObject = 'posts_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Example\Manage\Model\Posts', 'Example\Manage\Model\ResourceModel\Posts');
    }

}

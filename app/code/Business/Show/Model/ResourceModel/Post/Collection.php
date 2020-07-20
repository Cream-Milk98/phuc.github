<?php
namespace Business\Show\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'product_id';
    protected $_eventPrefix = 'catalog_category_product';
    protected $_eventObject = 'post_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Business\Show\Model\Post', 'Business\Show\Model\ResourceModel\Post');
    }

}

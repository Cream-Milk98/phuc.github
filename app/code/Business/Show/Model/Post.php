<?php
namespace Business\Show\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = '';

    protected $_cacheTag = 'catalog_category_product';

    protected $_eventPrefix = 'catalog_category_product';

    protected function _construct()
    {
        $this->_init('Business\Show\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}

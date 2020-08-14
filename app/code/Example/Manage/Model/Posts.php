<?php

namespace Example\Manage\Model;
class Posts extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'product_daily_deals';

    protected $_cacheTag = 'product_daily_deals';

    protected $_eventPrefix = 'product_daily_deals';

    protected function _construct()
    {
        $this->_init('Example\Manage\Model\ResourceModel\Posts');
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

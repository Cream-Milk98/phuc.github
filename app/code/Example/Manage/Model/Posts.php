<?php

/**
 * Create model  name of Posts
 */
namespace Example\Manage\Model;


class Posts extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Map Resource Class At Model lass
     */
    public function _construct()
    {
        $this->_init(\Example\Manage\Model\ResourceModel\Posts::class);
    }
}

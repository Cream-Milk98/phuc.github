<?php

/**
 * Create Resource Model name for model  Posts \StackExchange\Example\Model\Posts
 * As Model name Posts then Resource model is Posts
 */

namespace Example\Manage\Model\ResourceModel;


class Posts extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    
    /**
     * Define table for this Resource model
     * @return void
     */
    public function _construct()
    {
        $this->_init('mageplaza_helloworld_post', 'post_id');
    }

}

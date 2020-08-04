<?php

/*
  * Collection Model Class .As Model and Resource model Class Name is Posts
 *  That create name Posts folder at Example\Manage\Model\ResourceModel
 */

namespace Example\Manage\Model\ResourceModel\Posts;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

   /**
    * Map Model CLass and Resource mode Class at COllection Class
    */
    protected $_idFieldName = 'post_id';
    public function _construct()
    {
        $this->_init(
                \Example\Manage\Model\Posts::class,
                 \Example\Manage\Model\ResourceModel\Posts::class
                );
    }

}

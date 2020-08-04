<?php

/**
 * Create model  name of Student
 */
namespace Example\Manage\Model;


class Student extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Map Resource Class At Model lass
     */
    public function _construct()
    {
        $this->_init(\Example\Manage\Model\ResourceModel\Student::class);
    }
}

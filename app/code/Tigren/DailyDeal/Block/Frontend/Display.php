<?php

namespace Tigren\DailyDeal\Block\Frontend;

use Tigren\DailyDeal\Model\PostsFactory;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Element\Template;

class Display extends Template
{
    protected $_postFactory;
    protected $registry;
    protected $_dataHelper;

    public function __construct(
        Context $context,
        PostsFactory $postFactory,
        Registry $registry,
        \Tigren\DailyDeal\Helper\Data $dataHelper,
        array $data = []
    )
    {
        $this->_postFactory = $postFactory;
        $this->registry = $registry;
        $this->_dataHelper = $dataHelper;
        parent::__construct($context, $data);
    }
    public function canShowBlock()
    {
        return $this->_dataHelper->isModuleEnabled();
    }
    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    public function getPostCollection()
    {
        $post = $this->_postFactory->create();
        return $post->getCollection();
    }
}

<?php

namespace Business\Show\Block;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Business\Show\Model\PostFactory;

class Display extends Template
{
    protected $_postFactory;

    public function __construct(
        Context $context,
        PostFactory $postFactory
    )
    {
        $this->_postFactory = $postFactory;
        parent::__construct($context);
    }
    public function getPostCollection()
    {
        $post = $this->_postFactory->create();
        return $post->getCollection();
    }
}

<?php

namespace Example\Manage\Block\Adminhtml;

use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;
use Example\Manage\Model\StudentFactory;

class Edit extends Template
{
    protected $_pageFactory;
    protected $_postLoader;
    protected $_request;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        StudentFactory $postLoader,
        Http $request,
        array $data = []
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_postLoader = $postLoader;
        $this->_request = $request;
        return parent::__construct($context, $data);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }

    public function getId()
    {
        $id = $this->_request->getParam('post_id');
        return $id;
    }

    public function get($id)
    {
        $custom = $this->_postLoader->create();
        $custom->load($id);
        return $custom;
    }
}

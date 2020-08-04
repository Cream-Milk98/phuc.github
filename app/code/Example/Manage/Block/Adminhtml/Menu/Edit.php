<?php

namespace Example\Manage\Block\Adminhtml\Menu;

use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;
use Example\Manage\Model\PostsFactory;

class Edit extends Template
{
    /**
     * @var \Example\Manage\Model\PostsFactory
     */
    private $postsFactory;

    /**
     * inject the model Class Factory for getting data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Example\Manage\Model\PostsFactory $postsFactory,
        array $data = array())
    {
        parent::__construct($context, $data);
        $this->postsFactory = $postsFactory;
    }

    public function getJohnInfo()
    {
        $postsModel = $this->postsFactory->create();

        /**
         * Using primary Id
         */
        $postsModel->load('post_id'); //John Primary

        return $postsModel;
    }
}

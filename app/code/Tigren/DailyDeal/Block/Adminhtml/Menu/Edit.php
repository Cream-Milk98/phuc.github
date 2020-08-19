<?php

namespace Tigren\DailyDeal\Block\Adminhtml\Menu;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;
use Tigren\DailyDeal\Model\PostsFactory;

class Edit extends Template
{
    protected $collectionFactory;
    protected $productRepository;
    private $postsFactory;

    /**
     * inject the model Class Factory for getting data
     */
    public function __construct(
        Context $context,
        PostsFactory $postsFactory,
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
        $postsModel->load('id'); //John Primary

        return $postsModel;
    }
}

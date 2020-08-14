<?php


namespace Example\Manage\Controller\Adminhtml\Example;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends  \Magento\Backend\App\Action
{
     /**
     * @url adminUrl/frontName/ControllerFolder/ActionfileName
     * @example adminUrl/exampleadmin/example/listing
     */

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory   
     ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute() 
    {
        $resultPage=  $this->resultPageFactory->create();
        $resultPage->getConfig()->setKeywords(__('Example Test KeyWord'));
        /**
         * Left menu Select
         */
        $resultPage->setActiveMenu('Example_Manage::menu');
        /**
         * Set Page title
         */
        $resultPage->getConfig()->getTitle()->set(_('Magento Manage'));
        $resultPage->addBreadcrumb(__('Hello'), __('Hello'));
        $resultPage->addBreadcrumb(__('Example'), __('Example'));
        return $resultPage;        
    }
}
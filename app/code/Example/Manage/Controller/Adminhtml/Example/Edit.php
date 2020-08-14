<?php
/**
 * Create edit page for Update data
 */

namespace Example\Manage\Controller\Adminhtml\Example;


class Edit extends  \Magento\Backend\App\Action
{
    private $registry;
    private $resultPageFactory;
    private $postsFactory;
    const ADMIN_RESOURCE ="Example_Manage::example_edit";

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Example\Manage\Model\PostsFactory $postsFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->postsFactory = $postsFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        parent::__construct($context);
    }

    public function execute() {

        $postsModel= $this->postsFactory->create();
        $id = $this->getRequest()->getParam('id');
        if($id){
            /**
             * Load a record data from data using model
             */
            $postsModel->load($id);
            /**
             * Redirect to listing page if a record does not exit at database
             * with request parameter
             */
            if(!$postsModel->getId()){
                $resultRedirect =  $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('manage/example/index');
            }

        }
        $this->registry->register('product_daily_deals',$postsModel);
        $resultPage =$this->resultPageFactory->create();
        $resultPage->getConfig()->setKeywords(__('Edit Page'));
        $resultPage->setActiveMenu('Example_Manage::menu');
        $resultPage->getConfig()->getTitle()->prepend('Example Module');
        $pageTitltPrefix = __('Edit Page for %1',
            $postsModel->getId()?$postsModel->getName(): __('New entry')
        );
        $resultPage->getConfig()->getTitle()->prepend($pageTitltPrefix);
        return $resultPage;

    }

}

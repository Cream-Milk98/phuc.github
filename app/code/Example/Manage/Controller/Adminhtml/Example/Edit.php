<?php
/**
 * Create edit page for Update data 
 */

namespace Example\Manage\Controller\Adminhtml\Example;


class Edit extends  \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @var \StackExchange\Example\Model\StudentFactory
     */
    private $yourModelVariableFactory;

    /**
     * 
     * Add Acl Resource id For Permission at admin section
     */
    const ADMIN_RESOURCE ="Example_Manage::example_edit";
    
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Example\Manage\Model\{YourModel}Factory $yourModelVariableFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry  
    ) {
        $this->yourModelVariableFactory = $yourModelVariableFactory;  
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;        
        parent::__construct($context);
    }

    public function execute() {
        
        /**
         * init Model using Model Factory
         */
        $yourModel= $this->yourModelVariableFactory->create();
        /**
         * for  update a row data, we need  primary  field value
         * which URL param "example_id" = Database example table "id" field
         */ 
        $id = $this->getRequest()->getParam('{Paramster_For_URL}');
        if($id){
            /**
             * Load a record data from data using model
             */
            $yourModel->load($id);
            /**
             * Redirect to listing page if a record does not exit at database 
             * with request parameter
             */
            if(!$yourModel->getId()){
               $resultRedirect =  $this->resultRedirectFactory->create();
               return $resultRedirect->setPath('*/*/listing');
            }
            
        }
        /**
         * Save Model Data to a registry variable for future purpose
         * Variable name is user defined
         */
        $this->registry->register('{Registry_Variable}',$yourModel);
        
        $resultPage =$this->resultPageFactory->create();
        $resultPage->getConfig()->setKeywords(__('Edit Page'));
        /**
         * Left menu Select
         */
        $resultPage->setActiveMenu('{MENU_ID}');
        /**
         * Set Page title
         */
        
        $resultPage->getConfig()->getTitle()->prepend('Example Module');
        $pageTitltPrefix = __('Edit Page for %1',
                $yourModel->getId()?$yourModel->getId(): __('New entry')
                );
        $resultPage->getConfig()->getTitle()->prepend($pageTitltPrefix);
        return $resultPage;
        
    }

}
<?php


namespace Tigren\DailyDeal\Controller\Adminhtml\Example;


class Delete  extends  \Magento\Backend\App\Action
{

    /**
     * Add ACL Resource TO this URL
     */
    /**
     * @var \Tigren\DailyDeal\Model\PostsFactory
     */
    private $postsFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Tigren\DailyDeal\Model\PostsFactory $postsFactory
    ) {
        $this->postsFactory = $postsFactory;
        parent::__construct($context);

    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        /**
         * Get Record id from Url parameters
         */
        $id = $this->getRequest()->getParam('id');

        if($id){
            $postsModel = $this->postsFactory->create();
            $postsModel->load($id);
            /**
             * If getId() has value then means record exits
             */
            if($postsModel->getId()){

                try{
                    $postsModel->delete();
                    $this->messageManager->addSuccessMessage(__('The record has been delete successfully'));
                } catch (\Exception $ex) {
                    $this->messageManager->addErrorMessage(__('Something wento to wrong while Delete'));
                }

                // after delete Record ,return to Listing page
                return $resultRedirect->setPath('manage/example/index');
            }

        }
        $this->messageManager->addErrorMessage(__('The Record does not exits'));
        //  Return to Listing page
        return $resultRedirect->setPath('manage/example/index');
    }

}

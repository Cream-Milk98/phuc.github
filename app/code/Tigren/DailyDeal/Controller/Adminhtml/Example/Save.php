<?php

namespace Tigren\DailyDeal\Controller\Adminhtml\Example;

use Magento\Framework\App\Request\DataPersistorInterface;

class Save extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE ="Tigren_DailyDeal::example_edit";

    private $dataPersistor;

    private $postsFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Tigren\DailyDeal\Model\PostsFactory $postsFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->postsFactory = $postsFactory;
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if($data){
            $postsModel = $this->postsFactory->create();
            $id = $this->getRequest()->getParam('id');

            /**
             *  set Id null when new record creating
             */

            if(empty($data['id'])){
                $data['id'] = null;
            }

            if($id){
                $postsModel->load($id);
            }


            $postsModel->setData($data);
            // Save Data using Model Save
            try{
                $postsModel->save();
                $this->messageManager->addSuccessMessage(__('Record SucessFully Update'));
                /**
                 * Clear Data From dataPersistor variable is successfully save
                 */
                $this->dataPersistor->clear('product_daily_deals');

                return $resultRedirect->setPath('manage/example/index', ['id' => $postsModel->getId() ]);

            } catch (\Exception $exception) {

                $this->messageManager->addExceptionMessage($exception,__('Something Went to Wrong While save data'));
            }
            /**
             * Send Post Data from Save to Edit page while any error happen on save of data
             */
            $this->dataPersistor->set('product_daily_deals',$data);
            return $resultRedirect->setPath('manage/example/edit', ['id' =>$id ]);

        }
        // if post does not find then redirect to Listing page
        return $resultRedirect->setPath('manage/example/index');
    }

}

<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Example\Manage\Ui\DataProvider\Form;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Example\Manage\Model\ResourceModel\Posts\CollectionFactory;

/**
 * DataProvider for product edit form
 *
 * @api
 * @since 101.0.0
 */
class DataProvider  extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{

    protected  $collection;
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var \Example\Manage\Model\ResourceModel\posts\CollectionFactory
     */
    private $postsCollectionFactory;

    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        DataPersistorInterface $dataPersistor,
        CollectionFactory $postsCollectionFactory,
        array $meta = array(),
        array $data = array(),
        \Magento\Ui\DataProvider\Modifier\PoolInterface $pool = null
    ) {
        $this->postsCollectionFactory = $postsCollectionFactory;
        /**
         * It most important assign ColectionFactoty to collection
         */
        $this->collection  = $postsCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct
        (
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data,
            $pool
        );

    }
    public function getData()
    {
        if(isset($this->loadedData)){
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        /**
         * @var \StackExchange\Example\Model\posts $posts
         */
        foreach ($items as $posts){
            $this->loadedData[$posts->getId()] = $posts->getData();
        }
        /**
         *  a variable to use future use for persist data from save Url
         */
        $data= $this->dataPersistor->get('example_data');
        /**
         * it use during new item create from New form
         */
        if(!empty($data)){
            $posts = $this->collection->getNewEmptyItem();
            $posts->setData($data);
            $this->loadedData[$posts->getId()] = $posts->getData();

            /**
             * Clear Previous One
             */
            $this->dataPersistor->clear('example_data');
        }
        return $this->loadedData;
    }
}

<?php

namespace Hello\World\Ui\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Backend\Model\UrlInterface;

class ExampleAction extends \Magento\Ui\Component\Listing\Columns\Column
{
    const EDIT_PAGE_URL_PATH = "hello/menu/edit";

    const DELETE_PAGE_URL_PATH = "hello/menu/delete";

    const ADD_PAGE_URL_PATH = "hello/menu/add";

    private $urlBuilder;
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [])
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
    }
    public function  prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])){
            foreach($dataSource['data']['items'] as & $item){
                if ($item['post_id']){
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'label' => __('Edit Action'),
                            'href' => $this->urlBuilder->getUrl(
                                self::EDIT_PAGE_URL_PATH,
                                [
                                    'example_id' => $item['post_id'],
                                ]
                            ),
                        ],
                        'delete' => [
                            'label' => __('Delete Action'),
                            'href' => $this->urlBuilder->getUrl(
                                self::DELETE_PAGE_URL_PATH,
                                [
                                    'example_id' => $item['post_id'],
                                ]
                            ),
                            'post' => true,
                            'confirm' => [
                                'title' => __('Delete %1', $item['name']),
                                'message' => __('Are you sure you want to delete a record of ?', $item['name']),
                            ],
                        ],
                    ];
                }
            }
        }
        return $dataSource;
    }
}

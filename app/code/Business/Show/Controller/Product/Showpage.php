<?php

namespace Business\Show\Controller\Product;

Class Showpage extends \Magento\Framework\App\Action\Action
{
	protected $categoryReponsitory;
	protected $_storeManager;
	protected $_coreRegistry;
	protected $_resultPageFactory;


	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Catalog\Api\CategoryReponsitoryInterface $categoryReponsitory,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Framework\Registry $coreRegistry,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
	)
	{
		$this->_coreRegistry = $coreRegistry;
		$this->categoryReponsitory = $categoryReponsitory;
		$this->_storeManager = $storeManager;
		$this->_resultPageFactory = $resultPageFactory;
		parent::_construct($context);
	}

	public function execute()
	{
		$store =$this->_storeManager->getStore();
		$category= $this->categoryReponsitory->get($store->getRootCategoryId());
		$this->_coreRegistry->register('current_category', $category);
		$page = $this->resultPageFactory->create();
		$page->getLayout()->->getBlock('page.main.title')->setPageTitle('Show Page Products');
		$page->getLayout()->getBlock('breadcrumbs')->addCrumb(
			'home',
			[
				'label' =>__('Home'),
				'title' =>__('Go To Home Page'),
				'link' => $store->getBaseUrl()
			]

		)->addCrumb(
			'product-tag',
			[
				'label' => __('Show Page Products'),
				'title' => __('Show Page Products')
			]
		);
		$page->getConfig()->addBodyClass('page-products');
		$page->getConfig()->getTitle()->set(__('Show Page Products'));
		$page->getConfig()->setDescription(__('Show Page Products'));
		$page->getConfig()->setKeywords(__('Show Page Products'));
		$page->getConfig()->addRemotePageAsset($this->_url->getUrl('show/product/showpage'),'canonical',['attributes' => ['rel' => 'canonical']]);
		return $page;
	}

}
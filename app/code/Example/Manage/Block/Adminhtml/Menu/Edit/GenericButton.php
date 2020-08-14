<?php


namespace Example\Manage\Block\Adminhtml\Menu\Edit;


class GenericButton
{


    private $context;

    private $postsFactory;

    public function __construct(
      \Example\Manage\Model\PostsFactory $postsFactory,
      \Magento\Backend\Block\Widget\Context  $context
 ) {

    $this->postsFactory = $postsFactory;
    $this->context = $context;
}
  public function getId()
{

    /**
     * Get Url param  value
     */
    if($this->context->getRequest()->getParam('id')){
        $posts= $this->postsFactory->create();
        $posts->load($this->context->getRequest()->getParam('id'));

        return $posts->getId();
    }
    return false;
}
  public function getUrlBuilder()
{
    return $this->context->getUrlBuilder();
}
}

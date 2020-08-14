<?php

namespace Example\Manage\Block\Adminhtml\Menu\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
class BackButton  extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData() {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrlBuilder()->getUrl('manage/example/index')),
            'class' => 'back',
            'sort_order' => 50
        ];
    }

}

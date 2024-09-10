<?php
namespace Kitchen\Notice\Block\Adminhtml\Notices;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [];
    }
    
}

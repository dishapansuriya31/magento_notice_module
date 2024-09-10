<?php

namespace Kitchen\Notice\Model;

class Notices extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Kitchen\Notice\Model\ResourceModel\Notices::class);
    }
}

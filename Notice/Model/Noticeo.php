<?php

namespace Kitchen\Notice\Model;

class Noticeo extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init(\Kitchen\Notice\Model\ResourceModel\Noticeo::class);
    }
}

<?php

namespace Kitchen\Notice\Model\ResourceModel;

class Notices extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('Kitchen_notice', 'notice_id');
    }
}

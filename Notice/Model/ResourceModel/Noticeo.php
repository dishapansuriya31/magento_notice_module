<?php

namespace Kitchen\Notice\Model\ResourceModel;

class Noticeo extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('customer_notice', 'entity_id');
    }
}

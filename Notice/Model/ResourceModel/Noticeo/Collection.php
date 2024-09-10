<?php

namespace Kitchen\Notice\Model\ResourceModel\Noticeo;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idName = 'entity_id';
    protected function _construct()
    {
        $this->_init(
            \Kitchen\Notice\Model\Noticeo::class,
            \Kitchen\Notice\Model\ResourceModel\Noticeo::class
        );
    }
}

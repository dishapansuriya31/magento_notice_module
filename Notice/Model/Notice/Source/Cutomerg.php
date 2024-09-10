<?php
namespace Kitchen\Notice\Model\Notice\Source;

use Magento\Framework\Option\ArrayInterface;

class Customerg implements ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => '1', 'label' => __('General')],
            ['value' => '2', 'label' => __('Retailer')],
            ['value' => '3', 'label' => __('Wholesale')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            '1' => __('General'),
            '2' => __('Retailer'),
            '3' => __('Wholesale')
        ];
    }
}

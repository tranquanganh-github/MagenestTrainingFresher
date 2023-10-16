<?php

namespace Magenest\Movie\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class CustomSelect implements ArrayInterface
{

    public function toOptionArray()
    {
        return [['value' => 1, 'label' => __('Show')], ['value' => 2, 'label' => __('No-Show')]];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [2 => __('No-Show'), 1 => __('Show')];
    }
}

<?php

namespace Correction\TP4\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Vendor
 * @package Correction\TP4\Model
 */
class Vendor extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Vendor::class);
    }
}
<?php

namespace Correction\TP4\Model;

use Magento\Framework\Model\AbstractModel;

/**
 * Class Series
 * @package Correction\TP4\Model
 */
class Series extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Series::class);
    }
}
<?php

namespace Correction\TP4\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Series
 * @package Correction\TP4\Model\ResourceModel
 */
class Series extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('correction_tp4_series', 'series_id');
    }
}
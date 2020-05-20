<?php

namespace Correction\TP4\Model\ResourceModel\Series;

use Correction\TP4\Model\ResourceModel\Series as SeriesResource;
use Correction\TP4\Model\Series as SeriesModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(SeriesModel::class,SeriesResource::class);
    }
}
<?php

namespace Correction\TP4\Controller\Series;

use Correction\TP4\Controller\AbstractEdit;
use Correction\TP4\Model\ResourceModel\Series as SeriesResource;
use Correction\TP4\Model\SeriesFactory;
use Magento\Framework\App\Action\Context;

/**
 * Class Edit
 * @package Correction\TP4\Controller\Series
 */
class Edit extends AbstractEdit
{
    /**
     * Edit constructor.
     * @param Context $context
     * @param SeriesFactory $modelFactory
     * @param SeriesResource $modelResource
     */
    public function __construct(
        Context $context,
        SeriesFactory $modelFactory,
        SeriesResource $modelResource
    )
    {
        parent::__construct($context, $modelFactory, $modelResource);
        $this->isNew = false;
        $this->modelRequiredFields[] = 'color';
    }
}
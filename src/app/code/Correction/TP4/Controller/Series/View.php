<?php

namespace Correction\TP4\Controller\Series;

use Correction\TP4\Controller\AbstractView;
use Correction\TP4\Model\ResourceModel\Series as SeriesResource;
use Correction\TP4\Model\SeriesFactory;
use Magento\Framework\App\Action\Context;

/**
 * Class View
 * @package Correction\TP4\Controller\Series
 */
class View extends AbstractView
{
    /**
     * View constructor.
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
    }
}
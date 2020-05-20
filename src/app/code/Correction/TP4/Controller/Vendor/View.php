<?php

namespace Correction\TP4\Controller\Vendor;

use Correction\TP4\Controller\AbstractView;
use Correction\TP4\Model\ResourceModel\Vendor as VendorResource;
use Correction\TP4\Model\Vendor;
use Correction\TP4\Model\VendorFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

/**
 * Class View
 * @package Correction\TP4\Controller\Vendor
 */
class View extends AbstractView
{
    /**
     * View constructor.
     * @param Context $context
     * @param VendorFactory $modelFactory
     * @param VendorResource $modelResource
     */
    public function __construct(
        Context $context,
        VendorFactory $modelFactory,
        VendorResource $modelResource
    )
    {
        parent::__construct($context, $modelFactory, $modelResource);
    }
}
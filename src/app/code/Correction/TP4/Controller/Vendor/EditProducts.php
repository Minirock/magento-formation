<?php

namespace Correction\TP4\Controller\Vendor;

use Correction\TP4\Controller\AbstractEdit;
use Correction\TP4\Model\ResourceModel\Vendor as VendorResource;
use Correction\TP4\Model\VendorFactory;
use Magento\Framework\App\Action\Context;

/**
 * Class EditProducts
 * @package Correction\TP4\Controller\Vendor
 */
class EditProducts extends AbstractEdit
{
    /**
     * EditProducts constructor.
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
        $this->isNew = false;
        $this->modelRequiredFields = ['product_ids'];
    }
}
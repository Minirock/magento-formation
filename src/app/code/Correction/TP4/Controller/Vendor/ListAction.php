<?php

namespace Correction\TP4\Controller\Vendor;

use Correction\TP4\Controller\AbstractListAction;
use Correction\TP4\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Framework\App\Action\Context;

/**
 * Class ListAction
 * @package Correction\TP4\Controller\Vendor
 */
class ListAction extends AbstractListAction
{
    /**
     * ListAction constructor.
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory
    )
    {
        parent::__construct($context, $collectionFactory);
    }
}
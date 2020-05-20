<?php

namespace Correction\TP7\Controller\Index;

use Magento\Customer\Model\CustomerFactory;
use Magento\Customer\Model\ResourceModel\Customer;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package Correction\TP7\Controller\Index
 */
class Index extends Action
{
    /**
     * @var Customer
     */
    protected $customerResource;
    /**
     * @var CustomerFactory
     */
    protected $customerFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param Customer $customerResource
     * @param CustomerFactory $customerFactory
     */
    public function __construct(
        Context $context,
        Customer $customerResource,
        CustomerFactory $customerFactory
    )
    {
        parent::__construct($context);
        $this->customerResource = $customerResource;
        $this->customerFactory = $customerFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $random = $this->getRequest()->getParam('random');

        $json = [];

        if($id)
        {
            $customer = $this->customerFactory->create();
            if($random)
            {
                $customer->setRandom(true);
            }
            $this->customerResource->load($customer, $id);
            $json = $customer->getData();
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($json);
    }
}
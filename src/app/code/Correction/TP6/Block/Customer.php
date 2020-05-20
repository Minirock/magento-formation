<?php

namespace Correction\TP6\Block;

use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;

/**
 * Class Customer
 * @package Correction\TP6\Block
 */
class Customer extends Template
{
    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * Customer constructor.
     * @param Template\Context $context
     * @param Session $customerSession
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Session $customerSession,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->customerSession = $customerSession;
    }

    /**
     * @return array|\Magento\Framework\DataObject[]
     */
    public function getAddresses()
    {
        return $this->customerSession->isLoggedIn() ?
                $this->customerSession->getCustomer()->getAddresses() :
                [];
    }

    /**
     * @return array
     */
    public function getCustomerData()
    {
        $data = [];
        if($this->customerSession->isLoggedIn())
        {
            $customer = $this->customerSession->getCustomer();
            /** @var \Magento\Customer\Model\Customer $customer */
            $data['Firstname'] = $customer->getFirstname();
            $data['Lastname'] = $customer->getLastname();
            $data['Email'] = $customer->getEmail();
        }
        return $data;
    }
}
<?php

namespace Correction\TP7\Plugin;

use Magento\Customer\Model\Session;

/**
 * Class ShowTrigrammeOnFrontend
 * @package Correction\TP7\Plugin
 */
class ShowTrigrammeOnFrontend
{
    /** @var Session  */
    protected $session;

    /**
     * ShowTrigrammeOnFrontend constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param \Correction\TP6\Block\Customer $subject
     * @param array $data
     * @return array
     */
    public function afterGetCustomerData(\Correction\TP6\Block\Customer $subject, $data)
    {
        if(!$this->session->isLoggedIn())
        {
            return $data;
        }
        $customer = $this->session->getCustomer();
        $data['Trigramme'] = $customer->getData('trigramme');
        return $data;
    }
}
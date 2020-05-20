<?php

namespace Correction\TP7\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class AddTrigramme
 * @package Correction\TP7\Observer
 */
class AddTrigramme implements ObserverInterface
{
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Customer\Model\Customer $customer */
        $customer = $observer->getEvent()->getData('customer');
        $firstname = $customer->getData('firstname');
        $lastname = $customer->getData('lastname');
        $customer->setData('trigramme', strtoupper(
            (strlen($firstname) >= 1 ? substr($firstname, 0,  1) : '').
            (strlen($lastname) >= 2 ? substr($lastname, 0,  2) : '')
        ));
    }
}
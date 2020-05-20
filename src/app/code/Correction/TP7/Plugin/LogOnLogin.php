<?php

namespace Correction\TP7\Plugin;

use Magento\Customer\Model\Session;
use Psr\Log\LoggerInterface;

/**
 * Class LogOnLogin
 * @package Correction\TP7\Plugin
 */
class LogOnLogin
{
    /** @var LoggerInterface  */
    protected $logger;

    /**
     * LogOnLogin constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }

    /**
     * @param Session $subject
     * @return array
     */
    public function beforeRegenerateId(Session $subject)
    {
        $this->logger->critical('LOGGED IN!!!');
        return [];
    }
}
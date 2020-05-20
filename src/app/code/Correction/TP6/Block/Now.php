<?php

namespace Correction\TP6\Block;

use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;

/**
 * Class Now
 * @package Correction\TP6\Block
 */
class Now extends \Magento\Framework\View\Element\AbstractBlock
{
    /**
     * @return string
     */
    protected function _toHtml()
    {
        return '<div>'.date('r').'</div>';
    }
}
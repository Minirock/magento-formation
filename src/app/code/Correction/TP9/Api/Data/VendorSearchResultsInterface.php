<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Correction\TP9\Api\Data;

/**
 * Interface VendorSearchResultsInterface
 * @package Correction\TP9\Api\Data
 */
interface VendorSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get attributes list.
     *
     * @return \Correction\TP9\Api\Data\VendorInterface[]
     */
    public function getItems();

    /**
     * Set attributes list.
     *
     * @param \Correction\TP9\Api\Data\VendorInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

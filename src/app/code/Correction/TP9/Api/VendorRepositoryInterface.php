<?php

namespace Correction\TP9\Api;

/**
 * Interface VendorRepositoryInterface
 * @package Correction\TP9\Api
 */
interface VendorRepositoryInterface
{
    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Correction\TP9\Api\Data\VendorSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param int $id
     * @return \Correction\TP9\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($id);

    /**
     * @param \Correction\TP9\Api\Data\VendorInterface $vendor
     * @return \Correction\TP9\Api\Data\VendorInterface
     */
    public function save(\Correction\TP9\Api\Data\VendorInterface $vendor);

    /**
     * @param int $id
     * @return int[]
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getAssociatedProductIds($id);
}
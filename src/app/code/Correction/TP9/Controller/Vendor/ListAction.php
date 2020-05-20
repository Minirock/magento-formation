<?php

namespace Correction\TP9\Controller\Vendor;

use Correction\TP9\Api\Data\VendorInterface;
use Correction\TP9\Api\VendorRepositoryInterface;
use Correction\TP9\Controller\AbstractRepository;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class ListAction extends AbstractRepository
{
    public function __construct(
        Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        SortOrderBuilder $sortOrderBuilder,
        VendorRepositoryInterface $repository
    ) {
        parent::__construct($context, $searchCriteriaBuilder, $filterBuilder, $sortOrderBuilder, $repository);
    }


    function getItemData($item)
    {
        /** @var $item VendorInterface */
        return [
            'id' => $item->getId(),
            'name' => $item->getName()
        ];
    }
}
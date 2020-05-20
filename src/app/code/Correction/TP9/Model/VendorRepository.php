<?php

namespace Correction\TP9\Model;

use Correction\TP4\Model\VendorFactory;
use Correction\TP4\Model\ResourceModel\Vendor as VendorResource;
use Correction\TP4\Model\ResourceModel\Vendor\CollectionFactory as VendorCollectionFactory;
use Correction\TP9\Api\Data\VendorInterface;
use Correction\TP9\Api\Data\VendorSearchResultsInterface;
use Correction\TP9\Api\Data\VendorSearchResultsInterfaceFactory;
use Correction\TP9\Api\VendorRepositoryInterface;
use Correction\TP9\Helper\VendorConvert;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class VendorRepository implements VendorRepositoryInterface
{
    /**
     * @var VendorConvert
     */
    protected $vendorConvertHelper;
    /**
     * @var VendorFactory
     */
    protected $vendorFactory;
    /**
     * @var VendorResource
     */
    protected $vendorResource;
    /**
     * @var VendorCollectionFactory
     */
    protected $vendorCollectionFactory;

    /**
     * @var VendorSearchResultsInterfaceFactory
     */
    protected $searchResultsInterfaceFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    public function __construct(
        VendorConvert $vendorConvertHelper,
        VendorFactory $vendorFactory,
        VendorResource $vendorResource,
        VendorCollectionFactory $vendorCollectionFactory,
        VendorSearchResultsInterfaceFactory $searchResultsInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->vendorConvertHelper = $vendorConvertHelper;
        $this->vendorFactory = $vendorFactory;
        $this->vendorResource = $vendorResource;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->searchResultsInterfaceFactory = $searchResultsInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return VendorSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Correction\TP4\Model\ResourceModel\Vendor\Collection $vendorCollection */
        $vendorCollection = $this->vendorCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $vendorCollection);

        $items = [];
        foreach($vendorCollection as $vendor)
        {
            $items[] = $this->vendorConvertHelper->getVendorDTO($vendor);
        }
        /** @var VendorSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsInterfaceFactory->create();
        $searchResults->setSearchCriteria($searchCriteria)
            ->setTotalCount($vendorCollection->getSize())
            ->setItems($items);
        return $searchResults;
    }

    /**
     * @param int $id
     * @return VendorInterface
     * @throws NoSuchEntityException
     */
    public function get($id)
    {
        $vendorModel = $this->vendorFactory->create();
        $this->vendorResource->load($vendorModel, $id);
        if(!$vendorModel->getId())
        {
            throw new NoSuchEntityException(__('No vendor with ID %1', $id));
        }
        return $this->vendorConvertHelper->getVendorDTO($vendorModel);
    }

    /**
     * @param VendorInterface $vendor
     * @return VendorInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(VendorInterface $vendor)
    {
        $vendorModel = $this->vendorConvertHelper->getVendorModel($vendor);
        $this->vendorResource->save($vendorModel);
        return $this->vendorConvertHelper->getVendorDTO($vendorModel);
    }

    /**
     * @param int $id
     * @return int[]
     * @throws NoSuchEntityException
     */
    public function getAssociatedProductIds($id)
    {
        $vendorModel = $this->vendorFactory->create();
        $this->vendorResource->load($vendorModel, $id);
        if(!$vendorModel->getId())
        {
            throw new NoSuchEntityException(__('No vendor with ID %1', $id));
        }
        return $vendorModel->getProductIds();
    }
}
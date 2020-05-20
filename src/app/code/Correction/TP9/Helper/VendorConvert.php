<?php

namespace Correction\TP9\Helper;

use Correction\TP4\Model\ResourceModel\Vendor as VendorResource;
use Correction\TP4\Model\Vendor;
use Correction\TP9\Api\Data\VendorInterface;
use Correction\TP9\Api\Data\VendorInterfaceFactory;

use Correction\TP4\Model\VendorFactory;
use Correction\TP4\Model\ResourceModel\Vendor\CollectionFactory as VendorCollectionFactory;
use Correction\TP9\Api\Data\VendorSearchResultsInterfaceFactory;

class VendorConvert
{
    /**
     * @var VendorFactory
     */
    protected $vendorFactory;
    /**
     * @var VendorResource
     */
    protected $vendorResource;

    /**
     * @var VendorSearchResultsInterfaceFactory
     */
    protected $vendorDTOFactory;

    public function __construct(
        VendorFactory $vendorFactory,
        VendorResource $vendorResource,
        VendorInterfaceFactory $vendorDTOFactory
    )
    {
        $this->vendorFactory = $vendorFactory;
        $this->vendorResource = $vendorResource;
        $this->vendorDTOFactory = $vendorDTOFactory;
    }

    /**
     * @param VendorInterface $vendorDTO
     * @return Vendor
     */
    public function getVendorModel(VendorInterface $vendorDTO)
    {
        /** @var Vendor $vendorModel */
        $vendorModel = $this->vendorFactory->create();
        if($vendorDTO->getId())
        {
            $this->vendorResource->load($vendorModel, $vendorDTO->getId());
            if(!$vendorModel->getId())
            {
                $vendorModel->setId($vendorDTO->getId());
            }
        }
        $vendorModel->setName($vendorDTO->getName());
        return $vendorModel;
    }

    public function getVendorDTO(Vendor $vendor)
    {
        return $this->vendorDTOFactory->create()
            ->setId($vendor->getId())->setName($vendor->getName());
    }
}
<?php

namespace Correction\TP4\Model\ResourceModel\Vendor;

use Correction\TP4\Model\ResourceModel\Vendor as VendorResource;
use Correction\TP4\Model\Vendor as VendorModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $productLinkTable = null;

    protected function _construct()
    {
        $this->_init(VendorModel::class, VendorResource::class);
        $this->productLinkTable = $this->getTable('correction_tp4_catalog_product_vendor');
    }

    /**
     * @param int $productId
     * @return $this
     */
    public function addProductIdFilter($productId)
    {
        $this->getSelect()
            ->distinct(true)
            ->join(['product_link' => $this->productLinkTable], 'main_table.vendor_id = product_link.vendor_id', [])
            ->where('product_link.product_id = ?', $productId);
        return $this;
    }
}
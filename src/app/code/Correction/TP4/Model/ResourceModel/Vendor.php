<?php

namespace Correction\TP4\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Vendor
 * @package Correction\TP4\Model\ResourceModel
 */
class Vendor extends AbstractDb
{
    protected $productLinkTable = null;
    protected $savedProductIds = null;

    protected function _construct()
    {
        $this->_init('correction_tp4_vendor', 'vendor_id');
        $this->productLinkTable = $this->getTable('correction_tp4_catalog_product_vendor');
    }

    protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->productLinkTable, ['product_id'])
            ->where('vendor_id = ?', $object->getId());

        $productIds = [];
        foreach($connection->fetchAll($select) as $row)
        {
            $productIds[] = $row['product_id'];
        }
        $object->setData('product_ids', $productIds);

        return parent::_afterLoad($object);
    }

    /**
     * Perform actions before object save
     *
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $productIds = $object->getData('product_ids');
        $this->savedProductIds = is_array($productIds) ? $productIds : [];

        return parent::_beforeSave($object);
    }

    /**
     * Perform actions after object save
     *
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $vendorId = $object->getId();
        $toInsert = [];
        foreach($this->savedProductIds as $productId)
        {
            $toInsert[] = ['vendor_id' => $vendorId, 'product_id' => $productId];
        }
        $connection = $this->getConnection();
        $connection->delete($this->productLinkTable, $connection->quoteInto('vendor_id = ?', $vendorId));
        if($toInsert)
        {
            $connection->insertMultiple($this->productLinkTable, $toInsert);
        }

        return $this;
    }
}
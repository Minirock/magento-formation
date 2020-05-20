<?php

namespace Correction\TP9\Model\Data;

use Correction\TP9\Api\Data\VendorInterface;

/**
 * Class Vendor
 * @package Correction\TP9\Model\Data
 */
class Vendor implements VendorInterface
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
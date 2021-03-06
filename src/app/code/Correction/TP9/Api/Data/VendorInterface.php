<?php

namespace Correction\TP9\Api\Data;

/**
 * Interface VendorInterface
 * @package Correction\TP9\Api\Data
 */
interface VendorInterface
{
    const ID = 'id';
    const NAME = 'name';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);
}
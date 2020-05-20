<?php

namespace Correction\TP5\Model\Attribute\Source;

use Correction\TP4\Model\ResourceModel\Series\CollectionFactory;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
/**
 * Class Series
 * @package Correction\TP5\Model\Attribute\Source
 */
class Series extends AbstractSource
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var array
     */
    protected $options = null;

    /**
     * Series constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        if(is_null($this->options))
        {
            $this->options = [
                ['value' => '', 'label' => ' ']
            ];
            foreach($this->collectionFactory->create() as $serie)
            {
                $this->options[] = ['value' => $serie->getId(), 'label' => $serie->getName()];
            }
        }
        return $this->options;
    }

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        return $this->toOptionArray();
    }
}
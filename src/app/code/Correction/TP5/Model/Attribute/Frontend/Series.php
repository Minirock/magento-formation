<?php

namespace Correction\TP5\Model\Attribute\Frontend;

use Correction\TP4\Model\SeriesFactory;
use Correction\TP4\Model\ResourceModel\Series as SeriesResource;
use Magento\Eav\Model\Entity\Attribute\Source\BooleanFactory;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Serialize\Serializer\Json as Serializer;
use Magento\Store\Model\StoreManagerInterface;

class Series extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend
{
    /** @var SeriesFactory  */
    protected $seriesFactory;

    /** @var SeriesResource  */
    protected $seriesResource;

    /**
     * Series constructor.
     * @param BooleanFactory $attrBooleanFactory
     * @param SeriesFactory $seriesFactory
     * @param SeriesResource $seriesResource
     * @param CacheInterface|null $cache
     * @param null $storeResolver
     * @param array|null $cacheTags
     * @param StoreManagerInterface|null $storeManager
     * @param Serializer|null $serializer
     */
    public function __construct(
        BooleanFactory $attrBooleanFactory,
        SeriesFactory $seriesFactory,
        SeriesResource $seriesResource,
        CacheInterface $cache = null,
        $storeResolver = null,
        array $cacheTags = null,
        StoreManagerInterface $storeManager = null,
        Serializer $serializer = null
    ) {
        parent::__construct($attrBooleanFactory, $cache, $storeResolver, $cacheTags, $storeManager, $serializer);
        $this->seriesFactory = $seriesFactory;
        $this->seriesResource = $seriesResource;
    }

    /**
     * Retrieve attribute value
     *
     * @param \Magento\Framework\DataObject $object
     * @return mixed
     */
    public function getValue(\Magento\Framework\DataObject $object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        if($value)
        {
            /** @var \Correction\TP4\Model\Series $series */
            $series = $this->seriesFactory->create();
            $this->seriesResource->load($series, $value);
            if($series->getId())
            {
                return '<span style="color:'.$series->getColor().'">'.$series->getName().'</span>';
            }
        }
        return parent::getValue($object);
    }
}
<?php

namespace Correction\TP6ter\Block\Product;

use Magento\Catalog\Api\ProductRepositoryInterface;

/**
 * Class Vendors
 * @package Correction\TP6ter\Block\Product
 */
class Vendors extends \Magento\Catalog\Block\Product\View
{
    /** @var \Correction\TP4\Model\ResourceModel\Vendor\CollectionFactory  */
    protected $vendorCollectionFactory;

    /** @var null  */
    protected $vendors = null;

    /**
     * Vendors constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Url\EncoderInterface $urlEncoder
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Framework\Stdlib\StringUtils $string
     * @param \Magento\Catalog\Helper\Product $productHelper
     * @param \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig
     * @param \Magento\Framework\Locale\FormatInterface $localeFormat
     * @param \Magento\Customer\Model\Session $customerSession
     * @param ProductRepositoryInterface $productRepository
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     * @param \Correction\TP4\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Correction\TP4\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig,
            $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
        $this->vendorCollectionFactory = $vendorCollectionFactory;
    }

    /**
     * @return \Correction\TP4\Model\Vendor[]
     */
    public function getVendors()
    {
        if(is_null($this->vendors))
        {
            /** @var \Correction\TP4\Model\ResourceModel\Vendor\Collection $vendorsCollection */
            $vendorsCollection = $this->vendorCollectionFactory->create();
            $vendorsCollection->addProductIdFilter($this->getProduct()->getId());
            $this->vendors = $vendorsCollection->getItems();
        }
        return $this->vendors;
    }
}
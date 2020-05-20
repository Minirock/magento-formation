<?php

namespace Correction\TP3\Controller\Product;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class View extends Action
{
    /** @var \Magento\Catalog\Model\ProductFactory  */
    protected $productFactory;

    /** @var \Magento\Catalog\Model\ResourceModel\Product  */
    protected $productResource;

    /**
     * View constructor.
     * @param Context $context
     * @param \Magento\Catalog\Model\ProductFactory $productFactory
     * @param \Magento\Catalog\Model\ResourceModel\Product $productResource
     */
    public function __construct(
        Context $context,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Model\ResourceModel\Product $productResource
    )
    {
        parent::__construct($context);
        $this->productFactory = $productFactory;
        $this->productResource = $productResource;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $jsonData = [];

        $id = $this->getRequest()->getParam('id');
        if($id)
        {
            $product = $this->productFactory->create();
            $this->productResource->load($product, $id);
            if($product->getId())
            {
                $jsonData = [
                    'name' => $product->getName(),
                    'type' => $product->getTypeId(),
                    'sku' => $product->getSku()
                ];
            }
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($jsonData);
    }
}
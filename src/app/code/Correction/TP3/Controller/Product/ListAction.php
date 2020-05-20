<?php

namespace Correction\TP3\Controller\Product;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class ListAction extends Action
{
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * ListAction constructor.
     * @param Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     */
    public function __construct(
        Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    )
    {
        parent::__construct($context);
        $this->productCollectionFactory = $productCollectionFactory;
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

        $type = $this->getRequest()->getParam('type');
        $sort = $this->getRequest()->getParam('sort');
        $order = $this->getRequest()->getParam('order');
        $page = $this->getRequest()->getParam('page');
        $size = $this->getRequest()->getParam('size');
        if($type)
        {
            $collection = $this->productCollectionFactory->create();
            $collection->addAttributeToSelect('name');
            $collection->addFieldToFilter('type_id', $type);
            if(isset($sort) && in_array($order, ['asc', 'desc']))
            {
                $collection->setOrder($sort, $order);
            }
            if(isset($page) && isset($size))
            {
                $collection->setPage($page, $size);
            }
            foreach($collection as $product)
            {
                $jsonData[] = [
                    'name' => $product->getName(),
                    'type' => $product->getTypeId(),
                    'sku' => $product->getSku()
                ];
            }
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($jsonData);
    }
}
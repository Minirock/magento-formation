<?php

namespace Correction\TP4\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class AbstractListAction
 * @package Correction\TP4\Controller
 */
abstract class AbstractListAction extends Action
{
    protected $collectionFactory;

    /**
     * AbstractListAction constructor.
     * @param Context $context
     * @param $collectionFactory
     */
    public function __construct(
        Context $context,
        $collectionFactory
    )
    {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $jsonData = [];
        foreach($this->collectionFactory->create() as $model)
        {
            $jsonData[] = $model->getData();
        }
        return $this->getJsonResult($jsonData);
    }

    /**
     * @param $jsonData
     * @return Json
     */
    protected function getJsonResult($jsonData)
    {
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($jsonData);
    }
}
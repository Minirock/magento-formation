<?php

namespace Correction\TP4\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface as ResponseInterfaceAlias;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class AbstractView
 * @package Correction\TP4\Controller
 */
abstract class AbstractView extends Action
{
    protected $modelFactory;
    protected $modelResource;

    /**
     * AbstractView constructor.
     * @param Context $context
     * @param $modelFactory
     * @param $modelResource
     */
    public function __construct(
        Context $context,
        $modelFactory, $modelResource
    )
    {
        parent::__construct($context);
        $this->modelFactory = $modelFactory;
        $this->modelResource = $modelResource;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterfaceAlias
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if(!$id)
        {
            return $this->getJsonResult(['error' => __('No ID provided')]);
        }
        $model = $this->modelFactory->create();
        $this->modelResource->load($model, $id);
        if(!$model->getId())
        {
            return $this->getJsonResult(['error' => __('Invalid ID provided')]);
        }
        return $this->getJsonResult($model->getData());
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
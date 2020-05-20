<?php

namespace Correction\TP4\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class AbstractDelete
 * @package Correction\TP4\Controller
 */
abstract class AbstractDelete extends Action
{
    protected $modelFactory;
    protected $modelResource;

    /**
     * AbstractDelete constructor.
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
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
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
        try {
            $this->modelResource->delete($model);
        }
        catch(\Exception $e)
        {
            return $this->getJsonResult(['error' => $e->getMessage()]);
        }
        return $this->getJsonResult(['success' => __('Model %1 deleted from %2', $id, $this->modelResource->getMainTable())]);
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
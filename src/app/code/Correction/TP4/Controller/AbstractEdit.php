<?php

namespace Correction\TP4\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class AbstractEdit
 * @package Correction\TP4\Controller
 */
abstract class AbstractEdit extends Action
{
    protected $modelFactory;
    protected $modelResource;
    protected $modelRequiredFields = ['name'];
    protected $fieldAsArray = ['product_ids'];
    protected $isNew = false;

    /**
     * AbstractEdit constructor.
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
        $params = $this->getRequest()->getParams();
        $id = $this->getRequest()->getParam('id');
        if((!$this->isNew) && (!$id))
        {
            return $this->getJsonResult(['error' => __('No ID provided')]);
        }

        $model = $this->modelFactory->create();
        if(!$this->isNew)
        {
            $this->modelResource->load($model, $id);
        }
        if((!$this->isNew) && (!$model->getId()))
        {
            return $this->getJsonResult(['error' => __('Invalid ID provided')]);
        }

        $missingRequiredFields = [];
        foreach($this->modelRequiredFields as $field)
        {
            if((!isset($params[$field])) && (!$model->hasData($field)))
            {
                $missingRequiredFields[] = $field;
            }
        }
        if($missingRequiredFields)
        {
            return $this->getJsonResult(['error' => __('Missing required fields: %1', implode(',', $missingRequiredFields))]);
        }
        foreach($params as $key => $value)
        {
            if($key != 'id' && $key != $this->modelResource->getIdFieldName())
            {
                if(in_array($key, $this->fieldAsArray))
                {
                    $value = $value ? explode(',', $value) : [];
                    $model->setData($key, $value);
                }
                else
                {
                    $model->setData($key, $value);
                }
            }
        }
        try {
            $this->modelResource->save($model);
        }
        catch(\Exception $e)
        {
            return $this->getJsonResult(['error' => $e->getMessage()]);
        }
        return $this->getJsonResult(['success' => __('Saved in %1 with ID %2', $this->modelResource->getMainTable(), $model->getId())]);
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
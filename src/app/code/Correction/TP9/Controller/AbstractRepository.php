<?php

namespace Correction\TP9\Controller;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

abstract class AbstractRepository extends Action
{
    protected $repository;

    public function __construct(
        Context $context,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        SortOrderBuilder $sortOrderBuilder,
        $repository
    )
    {
        parent::__construct($context);
        $this->repository = $repository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
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
        $pageSize = $this->getRequest()->getParam('size', 30);
        $filters = $this->getRequest()->getParam('filters');
        $sort = $this->getRequest()->getParam('sort');
        $order = $this->getRequest()->getParam('order', 'asc');
        $page = $this->getRequest()->getParam('page', 1);

        $this->searchCriteriaBuilder->setCurrentPage($page)->setPageSize($pageSize);
        if($sort && $order)
        {
            $this->sortOrderBuilder->setField($sort);
            if($order == 'desc')
            {
                $this->sortOrderBuilder->setDescendingDirection();
            }
            else
            {
                $this->sortOrderBuilder->setAscendingDirection();
            }
            $this->searchCriteriaBuilder->addSortOrder(
                $this->sortOrderBuilder->create()
            );
        }
        if($filters)
        {
            $filters = explode(',',$filters);
            foreach($filters as $filter)
            {
                $filter = trim($filter);
                $match = [];
                if(preg_match('/^([A-Za-z0-9_]+)\=(.*)$/', $filter, $match))
                {
                    $this->searchCriteriaBuilder->addFilters([
                        $this->filterBuilder->setField($match[1])
                            ->setConditionType('eq')->setValue($match[2])->create()
                    ]);
                }
                if(preg_match('/^([A-Za-z0-9_]+)\(([a-z]+)\)(.*)$/', $filter, $match))
                {
                    $this->searchCriteriaBuilder->addFilters([
                        $this->filterBuilder->setField($match[1])
                            ->setConditionType($match[2])->setValue($match[2] == 'like' ? '%'.$match[3].'%' : $match[3])->create()
                    ]);
                }
            }
        }
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->repository->getList($searchCriteria);
        $jsonData = [
            'total_count' => $searchResult->getTotalCount(),
            'items' => []
        ];
        foreach($searchResult->getItems() as $item)
        {
            $jsonData['items'][] = $this->getItemData($item);
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($jsonData);
    }

    abstract function getItemData($item);
}
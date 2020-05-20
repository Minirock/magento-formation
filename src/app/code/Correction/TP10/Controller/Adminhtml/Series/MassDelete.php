<?php

namespace Correction\TP10\Controller\Adminhtml\Series;

use Correction\TP4\Model\ResourceModel\Series;
use Magento\Framework\App\Action\HttpPostActionInterface as HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;


use Correction\TP4\Model\ResourceModel\Series\CollectionFactory;

class MassDelete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    const ADMIN_RESOURCE = 'Correction_TP10::series_edit';

    /**
     * Massactions filter
     *
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var Series
     */
    protected $seriesResource;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        Series $vendorResource
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->seriesResource = $vendorResource;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        $seriesDeleted = 0;
        foreach ($collection->getItems() as $series) {
            $this->seriesResource->delete($series);
            $seriesDeleted++;
        }

        if ($seriesDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $seriesDeleted)
            );
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('correctiontp10/series/index');
    }
}

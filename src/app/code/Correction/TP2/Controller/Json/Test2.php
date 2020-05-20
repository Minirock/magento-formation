<?php


namespace Correction\TP2\Controller\Json;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\RedirectFactory;
use Zend\Mvc\Controller\Plugin\Service\ForwardFactory;

class Test2 extends Action
{
    /** @var JsonFactory  */
    protected $jsonFactory;

    /** @var ForwardFactory  */
    protected $forwardFactory;

    /** @var RedirectFactory  */
    protected $redirectFactory;

    /**
     * Test2 constructor.
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param ForwardFactory $forwardFactory
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        ForwardFactory $forwardFactory,
        RedirectFactory $redirectFactory
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->forwardFactory = $forwardFactory;
        $this->redirectFactory = $redirectFactory;
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
        $action = $this->getRequest()->getParam('action');
        switch($action)
        {
            case 'forward':
                $forward = $this->forwardFactory->create();
                $forward->forward('test1');
                return $forward;
            case 'redirect':
                $redirect = $this->redirectFactory->create();
                $redirect->setPath('*/*/test1');
                return $redirect;
            default:
                $json = $this->jsonFactory->create();
                $json->setData([
                    'logiciel' => 'magento', 'ville' => 'toulouse'
                ]);
                return $json;
        }
    }
}
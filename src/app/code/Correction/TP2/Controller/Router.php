<?php


namespace Correction\TP2\Controller;


use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{

    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;

    /**
     * Router constructor.
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     */
    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }

    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     * @return ActionInterface
     */
    public function match(RequestInterface $request)
    {
        $path = trim($request->getPathInfo(), '/');
        if($path == 'test1')
        {
            $request->setPathInfo('/correctiontp2/json/test1');
            return $this->actionFactory->create(
                \Magento\Framework\App\Action\Forward::class
            );
        }
        if($path == 'test2')
        {
            $request->setPathInfo('/correctiontp2/json/test2');
            return $this->actionFactory->create(
                \Magento\Framework\App\Action\Forward::class
            );
        }
        return null;
    }
}
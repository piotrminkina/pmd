<?php

namespace PMD\ResourcesResolverBundle\Factory;

use Symfony\Component\HttpFoundation\Request;
use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\Collector\MethodRequirements;
use PMD\ResourcesResolverBundle\Collector\FunctionRequirements;
use PMD\ResourcesResolverBundle\Injector\RequestAttributeInjector;

/**
 * Class RequestControllerFactory
 * @package PMD\ResourcesResolverBundle\Collector
 */
class RequestControllerFactory implements FactoryInterface
{
    /**
     * @var Request|null
     */
    protected $request;

    /**
     * @var callable|null
     */
    protected $controller;

    /**
     * @param Request $request
     * @return RequestControllerFactory
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return Request|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param callable $controller
     * @return RequestControllerFactory
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * @return callable|null
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @inheritdoc
     */
    public function createCollector()
    {
        $controller = $this->controller;
        $collector = null;

        if (is_array($controller) && count($controller) == 2) {
            $collector = new MethodRequirements($controller[0], $controller[1]);
        } elseif (is_string($controller)) {
            $collector = new FunctionRequirements($controller);
        }

        if (!$collector) {
            throw new InvalidArgumentException('Unsupported controller type');
        }
        $collector->collect();

        return $collector;
    }

    /**
     * @inheritdoc
     */
    public function createInjector()
    {
        $request = $this->request;

        if (!$request instanceof Request) {
            throw new InvalidArgumentException('Unsupported request type');
        }

        return new RequestAttributeInjector($this->request);
    }
}

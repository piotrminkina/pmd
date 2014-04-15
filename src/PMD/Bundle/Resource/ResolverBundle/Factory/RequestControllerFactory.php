<?php

namespace PMD\ResourcesResolverBundle\Factory;

use Symfony\Component\HttpFoundation\Request;
use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\RequirementsCollector\MethodRequirementsCollector;
use PMD\ResourcesResolverBundle\RequirementsCollector\FunctionRequirementsCollector;
use PMD\ResourcesResolverBundle\Injector\RequestAttributeInjector;

/**
 * Class RequestControllerFactory
 * @package PMD\ResourcesResolverBundle\RequirementsCollector
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

        if (is_array($controller)) {
            if (count($controller) == 2) {
                $method = new \ReflectionMethod($controller[0], $controller[1]);
                $collector = new MethodRequirementsCollector($method);
            }
        } elseif (is_scalar($controller)) {
            $function = new \ReflectionFunction($controller);
            $collector = new FunctionRequirementsCollector($function);
        }

        if (!$collector) {
            throw new InvalidArgumentException('Unsupported controller type');
        }
        $collector->collectRequirements();

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

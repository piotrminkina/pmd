<?php

namespace PMD\ResourcesResolverBundle\EventListener;

use PMD\ResourcesResolverBundle\Factory\FactoryInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * Class ControllerListener
 * @package PMD\ResourcesResolverBundle\EventListener
 */
class ControllerListener
{
    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        /*
        $controller = $event->getController();
        $request = $event->getRequest();

        $collector = $this->factory->createRequirementsCollector($controller);
        $injector = $this->factory->createResourcesInjector($request);
         */
    }
}

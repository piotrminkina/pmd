<?php

namespace PMD\ResourcesResolverBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use PMD\ResourcesResolverBundle\Factory\FactoryInterface;
use PMD\ResourcesResolverBundle\ResourcesResolverInterface;

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
     * @var ResourcesResolverInterface
     */
    protected $resolver;

    /**
     * @param FactoryInterface $factory
     * @param ResourcesResolverInterface $resolver
     */
    public function __construct(
        FactoryInterface $factory,
        ResourcesResolverInterface $resolver
    ) {
        $this->factory = $factory;
        $this->resolver = $resolver;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();
        $request = $event->getRequest();

        $collector = $this->factory->createRequirementsCollector($controller);
        $injector = $this->factory->createInjector($request);

        $this->resolver->resolveAndInject($collector, $injector);
    }
}

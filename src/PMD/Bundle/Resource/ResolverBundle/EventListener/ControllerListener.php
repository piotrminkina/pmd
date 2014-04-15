<?php

namespace PMD\ResourcesResolverBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use PMD\ResourcesResolverBundle\Factory\RequestControllerFactory;
use PMD\ResourcesResolverBundle\ResourcesResolverInterface;

/**
 * Class ControllerListener
 * @package PMD\ResourcesResolverBundle\EventListener
 */
class ControllerListener
{
    /**
     * @var RequestControllerFactory
     */
    protected $factory;

    /**
     * @var ResourcesResolverInterface
     */
    protected $resolver;

    /**
     * @param RequestControllerFactory $factory
     * @param ResourcesResolverInterface $resolver
     */
    public function __construct(
        RequestControllerFactory $factory,
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

        $this->factory->setController($controller);
        $this->factory->setRequest($request);

        $collector = $this->factory->createCollector($controller);
        $injector = $this->factory->createInjector($request);

        $this->resolver->resolveAndInject($collector, $injector);
    }
}

<?php

namespace PMD\ResourcesResolverBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use PMD\ResourcesResolverBundle\Factory\RequestControllerFactory;
use PMD\ResourcesResolverBundle\Resolver\ResolverInterface;

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
     * @var ResolverInterface
     */
    protected $resolver;

    /**
     * @param RequestControllerFactory $factory
     * @param ResolverInterface $resolver
     */
    public function __construct(
        RequestControllerFactory $factory,
        ResolverInterface $resolver
    ) {
        $this->factory = $factory;
        $this->resolver = $resolver;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $factory = $this->factory;
        $controller = $event->getController();
        $request = $event->getRequest();

        $factory->setController($controller);
        $factory->setRequest($request);

        $collector = $factory->createCollector($controller);
        $injector = $factory->createInjector($request);

        $this->resolver->resolveAndInject($collector, $injector);
    }
}

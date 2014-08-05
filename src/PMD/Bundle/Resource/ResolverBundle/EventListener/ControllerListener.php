<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\Resource\ResolverBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use PMD\Bundle\Resource\ResolverBundle\Factory\RequestControllerFactory;

/**
 * Class ControllerListener
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\EventListener
 */
class ControllerListener implements EventSubscriberInterface
{
    /**
     * @var RequestControllerFactory
     */
    protected $factory;

    /**
     * @param RequestControllerFactory $factory
     */
    public function __construct(RequestControllerFactory $factory)
    {
        $this->factory = $factory;
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

        $collector = $factory->createCollector();
        $injector = $factory->createInjector();
        $resolver = $factory->createResolver();

        $resolver->resolveAndInject($collector, $injector);
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => array('onKernelController', -64),
        );
    }
}

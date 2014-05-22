<?php

namespace PMD\FrontendBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class LayoutListener
 * @package PMD\FrontendBundle\EventListener
 */
class LayoutListener implements EventSubscriberInterface
{
    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();
        $parameters = $event->getControllerResult();

        if ($request->attributes->has('_layout')) {
            if (null === $parameters) {
                $parameters = array();
            }

            if (!array_key_exists('_layout', $parameters)) {
                $parameters['_layout'] = $request->attributes->get('_layout');
            }
        }

        $event->setControllerResult($parameters);
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::VIEW => array('onKernelView', 64),
        );
    }
}

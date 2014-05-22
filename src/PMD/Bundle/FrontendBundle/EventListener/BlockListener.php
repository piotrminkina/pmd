<?php

namespace PMD\FrontendBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class BlockListener
 * @package PMD\FrontendBundle\EventListener
 */
class BlockListener implements EventSubscriberInterface
{
    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();
        $parameters = $event->getControllerResult();

        if ($request->attributes->has('_block')) {
            if (null === $parameters) {
                $parameters = array();
            }

            if (!array_key_exists('_block', $parameters)) {
                $parameters['_block'] = $request->attributes->get('_block');
            }

            $request->attributes->remove('_block');
        }

        if ($request->attributes->has('_block_vars')) {
            if (null === $parameters) {
                $parameters = array();
            }

            if (!array_key_exists('_block_vars', $parameters)) {
                $parameters['_block_vars'] = $request->attributes->get('_block_vars');
            }

            $request->attributes->remove('_block_vars');

            foreach ($parameters['_block_vars'] as $name => $value) {
                $parameters['block_' . $name] = $value;
            }

            unset($parameters['_block_vars']);
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

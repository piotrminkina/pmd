<?php

namespace PMD\FrontendBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser;

/**
 * Class TemplateListener
 * @package PMD\FrontendBundle\EventListener
 */
class TemplateListener implements EventSubscriberInterface
{
    /**
     * @var TemplateGuesser
     */
    protected $guesser;

    /**
     * @param TemplateGuesser $guesser
     */
    public function __construct(TemplateGuesser $guesser)
    {
        $this->guesser = $guesser;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function prepareTemplateOverride(FilterControllerEvent $event)
    {
        $request = $event->getRequest();

        if ($request->attributes->has('_template')) {
            $template = $request->attributes->get('_template');
            $request->attributes->set('_template_override', $template);
            $request->attributes->remove('_template');
        }
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();
        $request = $event->getRequest();
        $template = null;

        if (!is_array($controller)) {
            return;
        }

        if ($request->attributes->has('_template_override')) {
            $template = $request->attributes->get('_template_override');
            $request->attributes->remove('_template_override');
        } elseif (!$request->attributes->has('_template')) {
            $template = $this->guesser->guessTemplateName($controller, $request);
        }

        if (null !== $template) {
            $request->attributes->set('_template', $template);
        }
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => array(
                array('prepareTemplateOverride', 128),
                array('onKernelController', -256),
            ),
        );
    }
}

<?php

namespace PMD\FrontendBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser;

/**
 * Class ViewListener
 * @package PMD\FrontendBundle\EventListener
 */
class ViewListener implements EventSubscriberInterface
{
    /**
     * @var EngineInterface
     */
    protected $engine;
    
    /**
     * @var TemplateGuesser
     */
    protected $guesser;

    /**
     * @var array
     */
    protected $controller;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param EngineInterface $engine
     * @param TemplateGuesser $guesser
     */
    public function __construct(EngineInterface $engine, TemplateGuesser $guesser)
    {
        $this->engine = $engine;
        $this->guesser = $guesser;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $this->controller = $event->getController();
    }

    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $result = $event->getControllerResult();

        if (!is_array($this->controller) || !is_array($result)) {
            return;
        }

        $this->request = $event->getRequest();
        $view = $this->getView();

        if (!$this->engine->exists($view)) {
            return;
        }

        $viewVars = $result + $this->getViewVars();

        $event->setResponse(
            $this->engine->renderResponse($view, $viewVars)
        );
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => array('onKernelController', -256),
            KernelEvents::VIEW => array('onKernelView', 64),
        );
    }

    /**
     * @return string|TemplateReference
     */
    public function getView()
    {
        $view = $this->request->attributes->get('_view');

        if (null === $view) {
            $view = $this->guesser->guessTemplateName(
                $this->controller,
                $this->request
            );
        }

        return $view;
    }

    /**
     * @return array
     */
    public function getViewVars()
    {
        $vars = array();
        $attributes = $this->request->attributes;
        $varsGroups = array('document', 'layout', 'block');

        foreach ($varsGroups as $varsGroup) {
            $view = '_' . $varsGroup;
            $viewVars = $view . '_vars';

            if ($attributes->has($view)) {
                $vars[$view] = $attributes->get($view);
            }

            if ($attributes->has($viewVars)) {
                $vars[$viewVars] = $attributes->get($viewVars);
            }
        }

        return $vars;
    }
}

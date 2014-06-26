<?php

/*
 * This file is part of the PMDFrontendBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\FrontendBundle\EventListener;

use PMD\FrontendBundle\Templating\FrontendVariables;
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
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\FrontendBundle\EventListener
 */
class ViewListener implements EventSubscriberInterface
{
    /**
     * @var EngineInterface
     */
    protected $engine;

    /**
     * @var FrontendVariables
     */
    protected $variables;
    
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
     * @param FrontendVariables $variables
     * @param TemplateGuesser $guesser
     */
    public function __construct(
        EngineInterface $engine,
        FrontendVariables $variables,
        TemplateGuesser $guesser
    ) {
        $this->engine = $engine;
        $this->variables = $variables;
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
        $request = $event->getRequest();
        $attributes = $request->attributes;
        $result = $event->getControllerResult();

        if (!is_array($this->controller) || !is_array($result)) {
            return;
        }
        $this->request = $request;

        $view = $attributes->get('_view');
        $vars = $attributes->get('_vars');

        if (empty($view) || !is_string($view)) {
            $view = $this->guessViewName();
        }
        if (empty($vars) || !is_array($vars)) {
            $vars = array();
        }

        if (!$this->engine->exists($view)) {
            return;
        }
        $this->variables->replace($vars);

        $event->setResponse(
            $this->engine->renderResponse($view, $result)
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
    public function guessViewName()
    {
        $view = $this->guesser->guessTemplateName(
            $this->controller,
            $this->request
        );

        return $view;
    }
}

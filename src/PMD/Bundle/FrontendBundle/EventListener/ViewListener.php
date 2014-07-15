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

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser;
use PMD\FrontendBundle\Templating\FrontendVariables;

/**
 * Class ViewListener
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\FrontendBundle\EventListener
 */
class ViewListener
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
     * @var string
     */
    protected $viewAttribute = '_view';

    /**
     * @var string
     */
    protected $varsAttribute = '_vars';

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
     * @param string $viewAttribute
     * @return ViewListener
     */
    public function setViewAttribute($viewAttribute)
    {
        $this->viewAttribute = $viewAttribute;

        return $this;
    }

    /**
     * @return string
     */
    public function getViewAttribute()
    {
        return $this->viewAttribute;
    }

    /**
     * @param string $varsAttribute
     * @return ViewListener
     */
    public function setVarsAttribute($varsAttribute)
    {
        $this->varsAttribute = $varsAttribute;

        return $this;
    }

    /**
     * @return string
     */
    public function getVarsAttribute()
    {
        return $this->varsAttribute;
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

        $view = $attributes->get($this->viewAttribute, null, true);
        $vars = $attributes->get($this->varsAttribute, null, true);

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

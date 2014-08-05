<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\FrontendBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference;
use Sensio\Bundle\FrameworkExtraBundle\Templating\TemplateGuesser;
use PMD\Bundle\FrontendBundle\Templating\FrontendVariables;

/**
 * Class ViewListener
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\FrontendBundle\EventListener
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
     * @var boolean
     */
    protected $autoGuess = true;

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
     * @param boolean $autoGuess
     * @return ViewListener
     */
    public function setAutoGuess($autoGuess)
    {
        $this->autoGuess = $autoGuess;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isAutoGuess()
    {
        return $this->autoGuess;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $request = $event->getRequest();
        $attributes = $request->attributes;

        $this->controller = $event->getController();
        $this->request = $request;

        $vars = $attributes->get($this->varsAttribute, null, true);

        if (empty($vars) || !is_array($vars)) {
            $vars = array();
        }
        $this->variables->replace($vars);
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

        $view = $attributes->get($this->viewAttribute, null, true);

        if (is_array($view)) {
            $action = basename($this->controller[1], 'Action');

            if (array_key_exists($action, $view)) {
                $view = $view[$action];
            } elseif (!empty($view['_default'])) {
                $view = $view['_default'];
            }
        }
        if ((empty($view) || !is_string($view)) && $this->autoGuess) {
            $view = $this->guessViewName();
        }

        if (!$this->engine->exists($view)) {
            return;
        }

        if ($view) {
            $event->setResponse(
                $this->engine->renderResponse($view, $result)
            );
        }
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

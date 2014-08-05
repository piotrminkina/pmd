<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\FrontendBundle\Twig;

use PMD\Bundle\FrontendBundle\Templating\FrontendVariables;

/**
 * Class PMDFrontendExtension
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\FrontendBundle\Twig
 */
class PMDFrontendExtension extends \Twig_Extension
{
    /**
     * @var FrontendVariables
     */
    protected $variables;

    /**
     * @var array
     */
    protected $contextStack;

    /**
     * @param FrontendVariables $variables
     */
    public function __construct(FrontendVariables $variables)
    {
        $this->variables = $variables;
        $this->contextStack = array();
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        $options = array(
            'needs_context' => true,
        );

        return array(
            new \Twig_SimpleFunction('pmd_frontend_push_context', array($this, 'pushContext'), $options),
            new \Twig_SimpleFunction('pmd_frontend_pop_context', array($this, 'popContext'), $options),
            new \Twig_SimpleFunction('pmd_frontend_*_*_or', array($this, 'getContext'), $options),
        );
    }

    /**
     * @param array $context
     */
    public function pushContext(array &$context)
    {
        $vars = $this->variables->all();
        $childVars = array();
        array_push($this->contextStack, $vars);

        if (isset($vars['child_vars']) && is_array($vars['child_vars'])) {
            $childVars = $vars['child_vars'];
        }
        unset($vars['child_vars']);

        $this->variables->replace($childVars);
        $context['pmd_frontend'] = $vars;
    }

    /**
     * @param array $context
     */
    public function popContext(array &$context)
    {
        $vars = array_pop($this->contextStack);
        $this->variables->replace($vars);
        $context['pmd_frontend'] = $vars;
    }

    /**
     * @param array $context
     * @param string $group
     * @param string $type
     * @param mixed $default
     * @return mixed|null
     */
    public function getContext(array $context, $group, $type, $default = null)
    {
        $name = $group . '_' . $type;
        $vars = null;

        if (isset($context['pmd_frontend']) && isset($context['pmd_frontend'][$name])) {
            $vars = $context['pmd_frontend'][$name];
        } elseif (isset($context[$name])) {
            $vars = $context[$name];
        } else {
            $vars = $default;
        }

        return $vars;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'pmd_frontend_extension';
    }
}

<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\Resource\ResolverBundle;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage as BaseExpressionLanguage;

/**
 * Class ExpressionLanguage
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle
 */
class ExpressionLanguage extends BaseExpressionLanguage
{
    protected function registerFunctions()
    {
        parent::registerFunctions();

        $this->register(
            'service',
            function ($id) {
                return sprintf('$this->container->get(%s)', $id);
            },
            function (array $variables, $id) {
                return $variables['container']->get($id);
            }
        );

        $this->register(
            'parameter',
            function ($name) {
                return sprintf('$this->container->getParameter(%s)', $name);
            },
            function (array $variables, $name) {
                return $variables['container']->getParameter($name);
            }
        );

        $this->register(
            'attribute',
            function ($args) {
                return sprintf('$this->request->attributes->get(%s)', $args);
            },
            function (array $variables, $path, $default = null, $deep = false) {
                return $variables['request']->attributes->get($path, $default, $deep);
            }
        );

        $this->register(
            'request',
            function ($args) {
                return sprintf('$this->request->request->get(%s)', $args);
            },
            function (array $variables, $path, $default = null, $deep = false) {
                return $variables['request']->request->get($path, $default, $deep);
            }
        );

        $this->register(
            'query',
            function ($args) {
                return sprintf('$this->request->query->get(%s)', $args);
            },
            function (array $variables, $path, $default = null, $deep = false) {
                return $variables['request']->query->get($path, $default, $deep);
            }
        );

        $this->register(
            'server',
            function ($args) {
                return sprintf('$this->request->server->get(%s)', $args);
            },
            function (array $variables, $path, $default = null, $deep = false) {
                return $variables['request']->server->get($path, $default, $deep);
            }
        );

        $this->register(
            'file',
            function ($args) {
                return sprintf('$this->request->files->get(%s)', $args);
            },
            function (array $variables, $path, $default = null, $deep = false) {
                return $variables['request']->files->get($path, $default, $deep);
            }
        );

        $this->register(
            'cookie',
            function ($args) {
                return sprintf('$this->request->cookies->get(%s)', $args);
            },
            function (array $variables, $path, $default = null, $deep = false) {
                return $variables['request']->cookies->get($path, $default, $deep);
            }
        );

        $this->register(
            'header',
            function ($args) {
                return sprintf('$this->request->headers->get(%s)', $args);
            },
            function (array $variables, $path, $default = null, $deep = false) {
                return $variables['request']->headers->get($path, $default, $deep);
            }
        );
    }
}

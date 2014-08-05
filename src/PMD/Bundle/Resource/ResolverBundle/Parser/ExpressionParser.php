<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\Resource\ResolverBundle\Parser;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use PMD\Bundle\Resource\ResolverBundle\ExpressionLanguage;

/**
 * Class ExpressionParser
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Parser
 */
class ExpressionParser implements ParserInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param ContainerInterface $container
     * @param Request $request
     */
    public function __construct(
        ContainerInterface $container,
        Request $request
    ) {
        $this->container = $container;
        $this->request = $request;
    }

    /**
     * @inheritdoc
     */
    public function parse($definition)
    {
        if (is_string($definition) && 0 === strpos($definition, '@=')) {
            $expression = new ExpressionLanguage();

            $definition = $expression->evaluate(
                substr($definition, 2),
                array(
                    'container' => $this->container,
                    'request' => $this->request,
                )
            );
        }

        return $definition;
    }
}

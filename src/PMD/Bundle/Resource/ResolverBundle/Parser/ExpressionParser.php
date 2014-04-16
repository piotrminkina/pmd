<?php

namespace PMD\ResourcesResolverBundle\Parser;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use PMD\ResourcesResolverBundle\ExpressionLanguage;

/**
 * Class ExpressionParser
 * @package PMD\ResourcesResolverBundle\Parser
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

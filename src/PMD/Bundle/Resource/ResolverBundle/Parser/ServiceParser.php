<?php

namespace PMD\ResourcesResolverBundle\Parser;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ServiceParser
 * @package PMD\ResourcesResolverBundle\Parser
 */
class ServiceParser implements ParserInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    public function parse($definition)
    {
        if (is_string($definition) && 0 === strpos($definition, '@')) {
            if (0 === strpos($definition, '@@')) {
                $definition = substr($definition, 1);
            } else {
                $definition = $this->container->get(substr($definition, 1));
            }
        }

        return $definition;
    }
}

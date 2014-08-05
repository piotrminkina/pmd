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

/**
 * Class ServiceParser
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Parser
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

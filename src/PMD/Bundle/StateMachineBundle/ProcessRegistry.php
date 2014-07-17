<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle;

use PMD\StateMachineBundle\Process\DefinitionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ProcessRegistry
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle
 */
class ProcessRegistry implements ProcessRegistryInterface
{
    /**
     * @var DefinitionInterface[]
     */
    protected $definitions;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param DefinitionInterface[] $definitions
     * @param ContainerInterface $container
     */
    public function __construct(
        array $definitions,
        ContainerInterface $container
    ) {
        $this->definitions = $definitions;
        $this->container = $container;
    }

    /**
     * @inheritdoc
     */
    public function getDefinition($name)
    {
        $serviceId = $this->definitions[$name];

        return $this->container->get($serviceId);
    }

    /**
     * @inheritdoc
     */
    public function hasDefinition($name)
    {
        return isset($this->definitions[$name]);
    }
}

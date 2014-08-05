<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Process;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Registry
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Process
 */
class Registry implements RegistryInterface
{
    /**
     * @var string[]
     */
    protected $definitions;

    /**
     * @var string[]
     */
    protected $coordinators;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param string[] $definitions
     * @param string[] $coordinators
     * @param ContainerInterface $container
     */
    public function __construct(
        array $definitions,
        array $coordinators,
        ContainerInterface $container
    ) {
        $this->definitions = $definitions;
        $this->coordinators = $coordinators;
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

    /**
     * @inheritdoc
     */
    public function getCoordinator($name)
    {
        $serviceId = $this->coordinators[$name];

        return $this->container->get($serviceId);
    }

    /**
     * @inheritdoc
     */
    public function hasCoordinator($name)
    {
        return isset($this->coordinators[$name]);
    }
}

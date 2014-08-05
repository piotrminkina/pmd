<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Action;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Traversable;

/**
 * Class Registry
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Action
 */
class Registry implements RegistryInterface
{
    protected $actions;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param string[] $actions
     * @param ContainerInterface $container
     */
    public function __construct(
        array $actions,
        ContainerInterface $container
    ) {
        $this->actions = $actions;
        $this->container = $container;
    }

    /**
     * @param string $name
     * @return AbstractTokenAction
     */
    public function getAction($name)
    {
        $serviceId = $this->actions[$name];

        return $this->container->get($serviceId);
    }

    /**
     * @param string $name
     * @return boolean
     */
    public function hasAction($name)
    {
        return isset($this->actions[$name]);
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        $actions = array();

        foreach ($this->actions as $name => $serviceId) {
            $actions[$name] = $this->container->get($serviceId);
        }

        return new \ArrayIterator($actions);
    }
}

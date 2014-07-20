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

use PMD\StateMachineBundle\Process\Registry\DefinitionRegistryInterface;
use PMD\StateMachineBundle\Process\DefinitionInterface;
use PMD\StateMachineBundle\Model\StatefulInterface;

/**
 * Class Factory
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle
 */
class Factory implements FactoryInterface
{
    /**
     * @var DefinitionRegistryInterface
     */
    protected $registry;

    /**
     * @param DefinitionRegistryInterface $registry
     */
    public function __construct(DefinitionRegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @inheritdoc
     */
    public function create($name, StatefulInterface $object)
    {
        $definition = $this->createDefinition($name);
        $coordinator = $this->createCoordinator($definition);
        $stateMachine = new StateMachine($object, $coordinator);

        return $stateMachine;
    }

    /**
     * @inheritdoc
     */
    public function createDefinition($name)
    {
        if (!$this->registry->hasDefinition($name)) {
            throw new \Exception(
                sprintf('Cannot create State Machine with definition named "%s", because definition is unknown', $name)
            );
        }

        return $this->registry->getDefinition($name);
    }

    /**
     * @inheritdoc
     */
    public function createCoordinator(DefinitionInterface $definition)
    {
        return new Coordinator($definition);
    }
}

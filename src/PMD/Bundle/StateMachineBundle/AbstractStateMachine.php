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
use PMD\StateMachineBundle\Process\StateInterface;
use PMD\StateMachineBundle\Process\TransitionInterface;
use PMD\StateMachineBundle\Model\StatefulInterface;

/**
 * Class AbstractStateMachine
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle
 */
abstract class AbstractStateMachine implements StateMachineInterface
{
    /**
     * @var StatefulInterface
     */
    protected $object;

    /**
     * @var DefinitionInterface
     */
    protected $definition;

    /**
     * @var StateMachineCoordinatorInterface
     */
    protected $coordinator;

    /**
     * @var StateInterface
     */
    protected $currentState;

    /**
     * @var TransitionInterface[]
     */
    protected $possibleTransitions;

    /**
     * @param StatefulInterface $object
     * @param DefinitionInterface $definition
     */
    public function __construct(
        StatefulInterface $object,
        DefinitionInterface $definition
    ) {
        $this->object = $object;
        $this->definition = $definition;
        $this->coordinator = $this->createCoordinator();

        $this->update();
    }

    /**
     * @inheritdoc
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @inheritdoc
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @inheritdoc
     */
    public function getCurrentState()
    {
        return $this->currentState;
    }

    /**
     * @inheritdoc
     */
    public function getPossibleTransitions()
    {
        return $this->possibleTransitions;
    }

    /**
     * @inheritdoc
     */
    public function hasPossibleTransition($label)
    {
        return isset($this->possibleTransitions[$label]);
    }

    /**
     * @inheritdoc
     */
    public function flowBy($label)
    {
        if (!isset($this->possibleTransitions[$label])) {
            throw new \Exception('Cannot flow by %s, because transition of this label doesn\'t exits');
        }
        $transition = $this->possibleTransitions[$label];
        $state = $this->coordinator->transit($transition);

        if (null !== $state) {
            $this->object->setState($state->getName());
            $this->update();
        }
    }

    /**
     */
    protected function update()
    {
        $coordinator = $this->coordinator;
        $this->currentState = $coordinator->getCurrentState();
        $this->possibleTransitions = $coordinator->getPossibleTransitions();
    }

    /**
     * @return StateMachineCoordinatorInterface
     */
    abstract protected function createCoordinator();
}

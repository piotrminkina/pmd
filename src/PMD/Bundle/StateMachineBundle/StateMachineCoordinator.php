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
use PMD\StateMachineBundle\Process\TransitionInterface;
use PMD\StateMachineBundle\Model\StatefulInterface;

/**
 * Class StateMachineCoordinator
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle
 */
class StateMachineCoordinator implements StateMachineCoordinatorInterface
{
    /**
     * @var StateMachineInterface
     */
    protected $stateMachine;

    /**
     * @var StatefulInterface
     */
    protected $object;

    /**
     * @var DefinitionInterface
     */
    protected $definition;

    /**
     * @param StateMachineInterface $stateMachine
     */
    public function __construct(StateMachineInterface $stateMachine)
    {
        $this->stateMachine = $stateMachine;
        $this->object = $stateMachine->getObject();
        $this->definition = $stateMachine->getDefinition();
    }

    /**
     * @inheritdoc
     */
    public function getCurrentState()
    {
        $states = $this->definition->getStates();
        $stateName = $this->object->getState();

        return $states[$stateName];
    }

    /**
     * @inheritdoc
     */
    public function getPossibleTransitions()
    {
        $possibleTransitions = array();
        $currentState = $this->stateMachine->getCurrentState();

        foreach ($this->definition->getTransitions() as $transition) {
            $sourceState = $transition->getSourceState();

            if ($currentState === $sourceState) {
                $label = $transition->getLabel();
                $possibleTransitions[$label] = $transition;
            }
        }

        return $possibleTransitions;
    }

    /**
     * @inheritdoc
     */
    public function transit(TransitionInterface $transition)
    {
        return $transition->getTargetState();
    }
}

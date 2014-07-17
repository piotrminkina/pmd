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

        $this->initCurrentState();
        $this->initPossibleTransitions();
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
     */
    protected function initCurrentState()
    {
        $states = $this->definition->getStates();
        $stateName = $this->object->getState();

        $this->currentState = $states[$stateName];
    }

    /**
     */
    protected function initPossibleTransitions()
    {
        $possibleTransitions = array();
        $currentState = $this->currentState;

        foreach ($this->definition->getTransitions() as $transition) {
            $sourceState = $transition->getSourceState();

            if ($currentState === $sourceState) {
                $label = $transition->getLabel();
                $possibleTransitions[$label] = $transition;
            }
        }

        $this->possibleTransitions = $possibleTransitions;
    }
}

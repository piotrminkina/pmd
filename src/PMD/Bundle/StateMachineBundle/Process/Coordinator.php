<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Process;

use PMD\StateMachineBundle\Process\Definition\StateInterface;
use PMD\StateMachineBundle\Process\Definition\TransitionInterface;

/**
 * Class Coordinator
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Process
 */
class Coordinator implements CoordinatorInterface
{
    /**
     * @var DefinitionInterface
     */
    protected $definition;

    /**
     * @param DefinitionInterface $definition
     */
    public function __construct(DefinitionInterface $definition)
    {
        $this->definition = $definition;
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
    public function getStateObject($name)
    {
        $states = $this->definition->getStates();
        $state = $states[$name];

        return $state;
    }

    /**
     * @inheritdoc
     */
    public function getAllowedTransitions(StateInterface $state, $context)
    {
        $possibleTransitions = array();

        foreach ($this->definition->getTransitions() as $transition) {
            if ($state === $transition->getSourceState()) {
                $label = $transition->getLabel();
                $possibleTransitions[$label] = $transition;
            }
        }

        return $possibleTransitions;
    }

    /**
     * @inheritdoc
     */
    public function complete(
        TransitionInterface $transition,
        $context,
        $data = null
    ) {
        return $context;
    }

    /**
     * @inheritdoc
     */
    public function isCompleted()
    {
        return true;
    }
}

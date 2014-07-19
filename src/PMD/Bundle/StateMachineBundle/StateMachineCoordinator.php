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

/**
 * Class StateMachineCoordinator
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle
 */
class StateMachineCoordinator implements StateMachineCoordinatorInterface
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
    public function getAllowedTransitions(StateInterface $state)
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

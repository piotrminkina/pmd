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
     * @var StateMachineCoordinatorInterface
     */
    protected $coordinator;

    /**
     * @var StateInterface
     */
    protected $state;

    /**
     * @var TransitionInterface[]
     */
    protected $transitions;

    /**
     * @param StatefulInterface $object
     * @param StateMachineCoordinatorInterface $coordinator
     */
    public function __construct(
        StatefulInterface $object,
        StateMachineCoordinatorInterface $coordinator
    ) {
        $this->object = $object;
        $this->coordinator = $coordinator;

        $this->updateMachine($object);
    }

    /**
     * @inheritdoc
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @inheritdoc
     */
    public function getTransitions()
    {
        return $this->transitions;
    }

    /**
     * @inheritdoc
     */
    public function hasTransition($label)
    {
        return isset($this->transitions[$label]);
    }

    /**
     * @inheritdoc
     */
    public function transit($label, $inputData = null)
    {
        if (!isset($this->transitions[$label])) {
            throw new \Exception('Cannot flow by %s, because transition of this label doesn\'t exits');
        }
        $transition = $this->transitions[$label];
        $outputData = $this->coordinator->transit($transition, $inputData);

        if ($this->coordinator->isCompleted()) {
            $state = $transition->getTargetState();
            $this->updateObject($state);
            $this->updateMachine($this->object);
        }

        return $outputData;
    }

    /**
     * @param StateInterface $state
     */
    protected function updateObject(StateInterface $state)
    {
        $this->object->setState($state->getName());
    }

    /**
     * @param StatefulInterface $object
     */
    protected function updateMachine(StatefulInterface $object)
    {
        $stateName = $object->getState();
        $coordinator = $this->coordinator;

        $this->state = $coordinator->getStateObject($stateName);
        $this->transitions = $coordinator->getAllowedTransitions($this->state);
    }
}

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

use PMD\Bundle\StateMachineBundle\Process\Definition\StateInterface;
use PMD\Bundle\StateMachineBundle\Process\Definition\TransitionInterface;

/**
 * Class Definition
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Process
 */
class Definition implements DefinitionInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var StateInterface[]
     */
    protected $states;

    /**
     * @var TransitionInterface[]
     */
    protected $transitions;

    /**
     */
    public function __construct()
    {
        $this->states = array();
        $this->transitions = array();
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setStates($states)
    {
        $this->states = $states;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addState(StateInterface $state)
    {
        $this->states[$state->getName()] = $state;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getStates()
    {
        return $this->states;
    }

    /**
     * @inheritdoc
     */
    public function setTransitions($transitions)
    {
        $this->transitions = $transitions;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addTransition(TransitionInterface $transition)
    {
        $this->transitions[$transition->getName()] = $transition;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTransitions()
    {
        return $this->transitions;
    }
}

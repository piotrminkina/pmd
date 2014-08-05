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
 * Interface DefinitionInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Process
 */
interface DefinitionInterface
{
    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param StateInterface[] $states
     * @return $this
     */
    public function setStates($states);

    /**
     * @param StateInterface $state
     * @return $this
     */
    public function addState(StateInterface $state);

    /**
     * @return StateInterface[]
     */
    public function getStates();

    /**
     * @param TransitionInterface[] $transitions
     * @return $this
     */
    public function setTransitions($transitions);

    /**
     * @param TransitionInterface $transition
     * @return $this
     */
    public function addTransition(TransitionInterface $transition);

    /**
     * @return TransitionInterface[]
     */
    public function getTransitions();
}

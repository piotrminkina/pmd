<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Definition;

/**
 * Interface DefinitionInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Definition
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

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
use PMD\Bundle\StateMachineBundle\StateMachineInterface;

/**
 * Interface TokenWriteInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Process
 */
interface TokenWriteInterface
{
    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @param boolean $consumed
     * @return $this
     */
    public function setConsumed($consumed);

    /**
     * @param mixed $context
     * @return $this
     */
    public function setContext($context);

    /**
     * @param StateMachineInterface $instance
     * @return $this
     */
    public function setInstance(StateMachineInterface $instance);

    /**
     * @param DefinitionInterface $definition
     * @return $this
     */
    public function setDefinition(DefinitionInterface $definition);

    /**
     * @param TransitionInterface $transition
     * @return $this
     */
    public function setTransition(TransitionInterface $transition);

    /**
     * @param StateInterface $targetState
     * @return $this
     */
    public function setTargetState(StateInterface $targetState);
}

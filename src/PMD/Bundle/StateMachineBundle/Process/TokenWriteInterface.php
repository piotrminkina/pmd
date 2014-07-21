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
use PMD\StateMachineBundle\StateMachineInterface;

/**
 * Interface TokenWriteInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Process
 */
interface TokenWriteInterface
{
    /**
     * @param string $name
     * @return Token
     */
    public function setName($name);

    /**
     * @param boolean $consumed
     * @return Token
     */
    public function setConsumed($consumed);

    /**
     * @param mixed $context
     * @return Token
     */
    public function setContext($context);

    /**
     * @param StateMachineInterface $instance
     * @return Token
     */
    public function setInstance(StateMachineInterface $instance);

    /**
     * @param DefinitionInterface $definition
     * @return Token
     */
    public function setDefinition(DefinitionInterface $definition);

    /**
     * @param TransitionInterface $transition
     * @return Token
     */
    public function setTransition(TransitionInterface $transition);

    /**
     * @param StateInterface $state
     * @return Token
     */
    public function setState(StateInterface $state);
}

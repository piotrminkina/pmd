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
 * interface TokenReadInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Process
 */
interface TokenReadInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return boolean
     */
    public function isConsumed();

    /**
     * @return mixed
     */
    public function getContext();

    /**
     * @return StateMachineInterface
     */
    public function getInstance();

    /**
     * @return DefinitionInterface
     */
    public function getDefinition();

    /**
     * @return TransitionInterface
     */
    public function getTransition();

    /**
     * @return StateInterface
     */
    public function getTargetState();
}

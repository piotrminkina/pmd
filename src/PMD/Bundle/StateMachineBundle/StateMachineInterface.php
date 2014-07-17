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
 * Interface StateMachineInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle
 */
interface StateMachineInterface
{
    /**
     * @return DefinitionInterface
     */
    public function getDefinition();

    /**
     * @return StateInterface
     */
    public function getCurrentState();

    /**
     * @return TransitionInterface[]
     */
    public function getPossibleTransitions();

    /**
     * @param string $label
     * @return boolean
     */
    public function hasPossibleTransition($label);
}

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

/**
 * Interface StateMachineCoordinatorInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle
 */
interface StateMachineCoordinatorInterface
{
    /**
     * @return StateInterface
     */
    public function getCurrentState();

    /**
     * @return TransitionInterface[]
     */
    public function getPossibleTransitions();

    /**
     * @param TransitionInterface $transition
     * @param mixed $data
     * @return StateInterface|null
     */
    public function transit(TransitionInterface $transition, $data = null);

    /**
     * @return boolean
     */
    public function isComplete();
}

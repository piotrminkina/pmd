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
 * Interface StateMachineInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle
 */
interface StateMachineInterface
{
    /**
     * @return StateInterface
     */
    public function getState();

    /**
     * @return TransitionInterface[]
     */
    public function getTransitions();

    /**
     * @param string $label
     * @return boolean
     */
    public function hasTransition($label);

    /**
     * @return mixed
     */
    public function getContext();

    /**
     * @param string $label
     * @param mixed $inputData
     * @return mixed
     * @throws \Exception
     */
    public function applyTransition($label, $inputData = null);
}

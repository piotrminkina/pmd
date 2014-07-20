<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Process\Definition;

/**
 * Interface TransitionInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Process\Definition
 */
interface TransitionInterface
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
     * @param string $label
     * @return $this
     */
    public function setLabel($label);

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @param StateInterface $sourceState
     * @return $this
     */
    public function setSourceState(StateInterface $sourceState);

    /**
     * @return StateInterface
     */
    public function getSourceState();

    /**
     * @param StateInterface $targetState
     * @return $this
     */
    public function setTargetState(StateInterface $targetState);

    /**
     * @return StateInterface
     */
    public function getTargetState();
}

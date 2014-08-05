<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Process\Definition;

/**
 * Interface TransitionInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Process\Definition
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
     * @param string $method
     * @return $this
     */
    public function setMethod($method);

    /**
     * @return string
     */
    public function getMethod();

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

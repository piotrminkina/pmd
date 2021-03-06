<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Process\Builder;

use PMD\Bundle\StateMachineBundle\Process\DefinitionInterface;

/**
 * Interface DefinitionBuilderInterface
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Process\Builder
 */
interface DefinitionBuilderInterface
{
    /**
     * @param string $name
     * @return $this
     */
    public function addState($name);

    /**
     * @param string $name
     * @param string $label
     * @param string $method
     * @return $this
     */
    public function addTransition($name, $label, $method);

    /**
     * @param string $sourceState
     * @param string $transition
     * @param string $targetState
     * @return $this
     */
    public function linkStates($sourceState, $transition, $targetState);

    /**
     * @param string $sourceStateState
     * @param string $transition
     * @return $this
     */
    public function linkSourceState($sourceStateState, $transition);

    /**
     * @param string $transition
     * @param string $targetStateState
     * @return $this
     */
    public function linkTargetState($transition, $targetStateState);

    /**
     * @return DefinitionInterface
     */
    public function getDefinition();
}

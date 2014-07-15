<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Definition\Builder;

use PMD\StateMachineBundle\Definition\DefinitionInterface;
use PMD\StateMachineBundle\Definition\StateInterface;
use PMD\StateMachineBundle\Definition\TransitionInterface;

/**
 * Interface DefinitionBuilderInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Definition\Builder
 */
interface DefinitionBuilderInterface
{
    /**
     * @return StateInterface
     */
    public function buildState();

    /**
     * @return TransitionInterface
     */
    public function buildTransition();

    /**
     * @param StateInterface $source
     * @param TransitionInterface $transition
     * @param StateInterface $target
     * @return $this
     */
    public function connectBoth(
        StateInterface $source,
        TransitionInterface $transition,
        StateInterface $target
    );

    /**
     * @param StateInterface $source
     * @param TransitionInterface $transition
     * @return $this
     */
    public function connectSource(
        StateInterface $source,
        TransitionInterface $transition
    );

    /**
     * @param TransitionInterface $transition
     * @param StateInterface $target
     * @return $this
     */
    public function connectTarget(
        TransitionInterface $transition,
        StateInterface $target
    );

    /**
     * @return DefinitionInterface
     */
    public function getDefinition();
}

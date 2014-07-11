<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\Definition\Builder;

use PMD\WorkflowBundle\Definition\Activity\ActivityInterface;
use PMD\WorkflowBundle\Definition\Transition\TransitionInterface;
use PMD\WorkflowBundle\Definition\WorkflowDefinitionInterface;

/**
 * Interface DefinitionBuilderInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Definition\Builder
 */
interface DefinitionBuilderInterface
{
    /**
     * @param string $type
     * @return ActivityInterface
     */
    public function buildActivity($type);

    /**
     * @param string $type
     * @return ActivityInterface
     */
    public function buildTransition($type);

    /**
     * @param TransitionInterface $transition
     * @param ActivityInterface $activity
     * @return DefinitionBuilderInterface
     */
    public function connectActivityInput(
        TransitionInterface $transition,
        ActivityInterface $activity
    );

    /**
     * @param ActivityInterface $activity
     * @param TransitionInterface $transition
     * @return DefinitionBuilderInterface
     */
    public function connectActivityOutput(
        ActivityInterface $activity,
        TransitionInterface $transition
    );

    /**
     * @return WorkflowDefinitionInterface
     */
    public function getDefinition();
}

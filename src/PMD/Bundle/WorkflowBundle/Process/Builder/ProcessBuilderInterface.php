<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\WorkflowBundle\Definition\Builder;

use PMD\Bundle\WorkflowBundle\Activity\ActivityInterface;
use PMD\Bundle\WorkflowBundle\Process\ProcessInterface;
use PMD\Bundle\WorkflowBundle\Transition\TransitionInterface;

/**
 * Interface ProcessBuilderInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\WorkflowBundle\Process\Builder
 */
interface ProcessBuilderInterface
{
    /**
     * @param string $type
     * @return ActivityInterface
     */
    public function buildActivity($type);

    /**
     * @param string $type
     * @return TransitionInterface
     */
    public function buildTransition($type);

    /**
     * @param TransitionInterface $transition
     * @param ActivityInterface $activity
     * @return ProcessBuilderInterface
     */
    public function connectActivityInput(
        TransitionInterface $transition,
        ActivityInterface $activity
    );

    /**
     * @param ActivityInterface $activity
     * @param TransitionInterface $transition
     * @return ProcessBuilderInterface
     */
    public function connectActivityOutput(
        ActivityInterface $activity,
        TransitionInterface $transition
    );

    /**
     * @return ProcessInterface
     */
    public function getDefinition();
}

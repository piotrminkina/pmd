<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\Transition;

use PMD\WorkflowBundle\Activity\ActivityInterface;

/**
 * A point during the execution of a process instance where one activity
 * completes and the thread of control passes to another, which starts.
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Transition
 */
interface TransitionInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param ActivityInterface $activity
     * @return TransitionInterface
     */
    public function setInputActivity(ActivityInterface $activity);

    /**
     * @return ActivityInterface
     */
    public function getInputActivity();

    /**
     * @param ActivityInterface $activity
     * @return TransitionInterface
     */
    public function setOutputActivity(ActivityInterface $activity);

    /**
     * @return ActivityInterface
     */
    public function getOutputActivity();
}

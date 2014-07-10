<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\Definition;

use Doctrine\Common\Collections\Collection;

/**
 * Interface DefinitionInterfaceq
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Definition
 */
interface DefinitionInterface
{
    /**
     * The process instance has been created, but may not yet be running.
     */
    const STATE_INITIATED = 'initiated';

    /**
     * The process instance has started execution and one or more of its
     * activities may be started.
     */
    const STATE_RUNNING = 'running';

    /**
     * One or more activities are started and activity instances exist
     * (further sub-states may be supported by particular implementations to
     * record more detailed information about active activities).
     */
    const STATE_ACTIVE = 'active';

    /**
     * The process instance is quiescent; no further activities are started
     * until it is resumed.
     */
    const STATE_SUSPENDED = 'suspended';

    /**
     * The process instance has achieved its completion conditions and any
     * post-completion system activities such as audit logging are in progress.
     */
    const STATE_COMPLETE = 'complete';

    /**
     * The execution of the process has been stopped (abnormally) due to error
     * or user request.
     */
    const STATE_TERMINATED = 'terminated';

    /**
     * The process instance has been placed in an indefinite archive state
     * (but may be retrieved for process resumption - typically supported only
     * for long-lived processes).
     */
    const STATE_ARCHIVED = 'archived';

    /**
     * @return string
     */
    public function getName();

    /**
     * @param Collection|ActivityInterface[] $activities
     * @return DefinitionInterface
     */
    public function setActivities(Collection $activities);

    /**
     * @param ActivityInterface $activity
     * @return DefinitionInterface
     */
    public function addActivity(ActivityInterface $activity);

    /**
     * @return Collection|ActivityInterface[]
     */
    public function getActivities();
}

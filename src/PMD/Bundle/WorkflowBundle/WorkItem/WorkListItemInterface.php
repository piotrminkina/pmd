<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\WorkflowBundle\WorkItem;

use PMD\Bundle\WorkflowBundle\Activity\Instance\ActivityInstanceInterface;

/**
 * The representation of the work to be processed (by a workflow participant)
 * in the context of an activity within a process instance.
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\WorkflowBundle\WorkItem
 */
interface WorkItemInterface
{
    /**
     * @param ActivityInstanceInterface $activityInstance
     * @return WorkItemInterface
     */
    public function setActivityInstance(ActivityInstanceInterface $activityInstance);

    /**
     * @return ActivityInstanceInterface
     */
    public function getActivityInstance();
}

<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\Activity\Instance;

use PMD\WorkflowBundle\Activity\ActivityInterface;
use PMD\WorkflowBundle\Process\Instance\ProcessInstanceInterface;

/**
 * The representation of an activity within a (single) enactment of a process,
 * i.e. within a process instance.
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Activity\Instance
 */
interface ActivityInstanceInterface
{
    /**
     * @param ActivityInterface $activity
     * @return ActivityInstanceInterface
     */
    public function setActivity(ActivityInterface $activity);

    /**
     * @return ActivityInterface
     */
    public function getActivity();

    /**
     * @param ProcessInstanceInterface $processInstance
     * @return ActivityInstanceInterface
     */
    public function setProcessInstance(ProcessInstanceInterface $processInstance);

    /**
     * @return ProcessInstanceInterface
     */
    public function getProcessInstance();
}

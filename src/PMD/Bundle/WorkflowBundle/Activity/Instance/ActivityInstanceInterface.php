<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\WorkflowBundle\Activity\Instance;

use PMD\Bundle\WorkflowBundle\Activity\ActivityInterface;
use PMD\Bundle\WorkflowBundle\Process\Instance\ProcessInstanceInterface;

/**
 * The representation of an activity within a (single) enactment of a process,
 * i.e. within a process instance.
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\WorkflowBundle\Activity\Instance
 */
interface ActivityInstanceInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $state
     * @return ActivityInstanceInterface
     */
    public function setState($state);

    /**
     * @return string
     */
    public function getState();

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

<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\Activity;

use Doctrine\Common\Collections\Collection;
use PMD\WorkflowBundle\Transition\TransitionInterface;

/**
 * A description of a piece of work that forms one logical step within
 * a process.
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Activity
 */
interface ActivityInterface
{
    /**
     * The activity instance has been created, but may not yet been activated;
     * no work item exists for that activity.
     */
    const STATE_INACTIVE = 'inactive';

    /**
     * One or more work items have been created and assigned for processing.
     */
    const STATE_ACTIVE = 'active';

    /**
     * The activity instance is quiescent; no further work items are started
     * until it is resumed (note that some activities may not be suspendable).
     */
    const STATE_SUSPENDED = 'suspended';

    /**
     * The process instance has achieved its completion conditions and any
     * post-completion system activities such as audit logging are in progress.
     */
    const STATE_COMPLETED = 'completed';

    /**
     * @return string
     */
    public function getName();

    /**
     * @param Collection|TransitionInterface[] $transitions
     * @return ActivityInterface
     */
    public function setInputTransitions(Collection $transitions);

    /**
     * @param TransitionInterface $transition
     * @return ActivityInterface
     */
    public function addInputTransition(TransitionInterface $transition);

    /**
     * @return Collection|TransitionInterface[]
     */
    public function getInputTransitions();

    /**
     * @param Collection|TransitionInterface[] $transitions
     * @return ActivityInterface
     */
    public function setOutputTransitions(Collection $transitions);

    /**
     * @param TransitionInterface $transition
     * @return ActivityInterface
     */
    public function addOutputTransition(TransitionInterface $transition);

    /**
     * @return Collection|TransitionInterface[]
     */
    public function getOutputTransitions();
}

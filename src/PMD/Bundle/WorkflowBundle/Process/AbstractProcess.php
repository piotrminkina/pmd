<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\Process;

use Doctrine\Common\Collections\Collection;
use PMD\WorkflowBundle\Activity\ActivityInterface;
use PMD\WorkflowBundle\Transition\TransitionInterface;

/**
 * Class AbstractProcess
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Process
 */
abstract class AbstractProcess implements ProcessInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Collection|ActivityInterface[]
     */
    protected $activities;

    /**
     * @var Collection|TransitionInterface[]
     */
    protected $transitions;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param Collection|ActivityInterface[] $activities
     * @return ProcessInterface
     */
    public function setActivities(Collection $activities)
    {
        $this->activities = $activities;

        return $this;
    }

    /**
     * @param ActivityInterface $activity
     * @return ProcessInterface
     */
    public function addActivity(ActivityInterface $activity)
    {
        $name = $activity->getName();
        $this->activities[$name] = $activity;

        return $this;
    }

    /**
     * @return Collection|ActivityInterface[]
     */
    public function getActivities()
    {
        return $this->activities;
    }

    /**
     * @param Collection|TransitionInterface[] $transitions
     * @return ProcessInterface
     */
    public function setTransitions(Collection $transitions)
    {
        $this->transitions = $transitions;

        return $this;
    }

    /**
     * @param TransitionInterface $transition
     * @return ProcessInterface
     */
    public function addTransition(TransitionInterface $transition)
    {
        $name = $transition->getName();
        $this->transitions[$name] = $transition;

        return $this;
    }

    /**
     * @return Collection|TransitionInterface[]
     */
    public function getTransitions()
    {
        return $this->transitions;
    }
}

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
use PMD\WorkflowBundle\Definition\Activity\ActivityInterface;
use PMD\WorkflowBundle\Definition\Transition\TransitionInterface;

/**
 * Class AbstractWorkflowDefinition
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Definition
 */
abstract class AbstractWorkflowDefinition
    implements WorkflowDefinitionInterface
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
     * @var Collection|ActivityInterface[]
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
     * @return WorkflowDefinitionInterface
     */
    public function setActivities(Collection $activities)
    {
        $this->activities = $activities;

        return $this;
    }

    /**
     * @param ActivityInterface $activity
     * @return WorkflowDefinitionInterface
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
     * @return WorkflowDefinitionInterface
     */
    public function setTransitions(Collection $transitions)
    {
        $this->transitions = $transitions;

        return $this;
    }

    /**
     * @param TransitionInterface $transition
     * @return WorkflowDefinitionInterface
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

<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Process;

/**
 * Class Transition
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Definition
 */
class Transition implements TransitionInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var StateInterface
     */
    protected $sourceState;

    /**
     * @var StateInterface
     */
    protected $targetState;

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @inheritdoc
     */
    public function setSourceState(StateInterface $sourceState)
    {
        $this->sourceState = $sourceState;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSourceState()
    {
        return $this->sourceState;
    }

    /**
     * @inheritdoc
     */
    public function setTargetState(StateInterface $targetState)
    {
        $this->targetState = $targetState;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTargetState()
    {
        return $this->targetState;
    }
}

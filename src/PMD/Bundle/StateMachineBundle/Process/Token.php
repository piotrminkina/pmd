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

use PMD\StateMachineBundle\Process\Definition\StateInterface;
use PMD\StateMachineBundle\Process\Definition\TransitionInterface;
use PMD\StateMachineBundle\StateMachineInterface;

/**
 * Class Token
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Process
 */
class Token implements TokenInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $consumed;

    /**
     * @var mixed
     */
    protected $context;

    /**
     * @var StateMachineInterface
     */
    protected $instance;

    /**
     * @var DefinitionInterface
     */
    protected $definition;

    /**
     * @var TransitionInterface
     */
    protected $transition;

    /**
     * @var StateInterface
     */
    protected $state;

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
    public function setConsumed($consumed)
    {
        $this->consumed = $consumed;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isConsumed()
    {
        return $this->consumed;
    }

    /**
     * @inheritdoc
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @inheritdoc
     */
    public function setInstance(StateMachineInterface $instance)
    {
        $this->instance = $instance;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * @inheritdoc
     */
    public function setDefinition(DefinitionInterface $definition)
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @inheritdoc
     */
    public function setTransition(TransitionInterface $transition)
    {
        $this->transition = $transition;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTransition()
    {
        return $this->transition;
    }

    /**
     * @inheritdoc
     */
    public function setState(StateInterface $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getState()
    {
        return $this->state;
    }
}

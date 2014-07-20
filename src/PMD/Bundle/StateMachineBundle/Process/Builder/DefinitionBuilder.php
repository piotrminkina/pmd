<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Process\Builder;

use PMD\StateMachineBundle\Process\Definition\StateInterface;
use PMD\StateMachineBundle\Process\Definition\TransitionInterface;
use PMD\StateMachineBundle\Process\Factory\DefinitionFactoryInterface;

/**
 * Class DefinitionBuilder
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Process\Builder
 */
class DefinitionBuilder implements DefinitionBuilderInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var DefinitionFactoryInterface
     */
    protected $factory;

    /**
     * @var StateInterface[]
     */
    protected $states;

    /**
     * @var TransitionInterface[]
     */
    protected $transitions;

    /**
     * @param DefinitionFactoryInterface $factory
     */
    public function __construct(DefinitionFactoryInterface $factory)
    {
        $this->factory = $factory;

        $this->states = array();
        $this->transitions = array();
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function addState($name)
    {
        $type = $this->factory->createState($name);
        $this->states[$name] = $type;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addTransition($name, $label)
    {
        $type = $this->factory->createTransition($name, $label);
        $this->transitions[$name] = $type;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function linkStates($sourceState, $transition, $targetState)
    {
        $this->linkSourceState($sourceState, $transition);
        $this->linkTargetState($transition, $targetState);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function linkSourceState($sourceState, $transition)
    {
        $sourceState = $this->states[$sourceState];
        $transition = $this->transitions[$transition];
        $transition->setSourceState($sourceState);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function linkTargetState($transition, $targetState)
    {
        $transition = $this->transitions[$transition];
        $targetState = $this->states[$targetState];
        $transition->setTargetState($targetState);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDefinition()
    {
        $type = $this->factory->createDefinition($this->name);
        $type
            ->setStates($this->states)
            ->setTransitions($this->transitions);

        return $type;
    }
}

<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Process\Decorator;

use PMD\StateMachineBundle\Process\CoordinatorInterface;
use PMD\StateMachineBundle\Process\Definition\StateInterface;
use PMD\StateMachineBundle\Process\Definition\TransitionInterface;

/**
 * Class AbstractCoordinatorDecorator
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Process\Decorator
 */
abstract class AbstractCoordinatorDecorator implements CoordinatorInterface
{
    /**
     * @var CoordinatorInterface
     */
    protected $coordinator;

    /**
     * @param CoordinatorInterface $coordinator
     */
    public function __construct(CoordinatorInterface $coordinator)
    {
        $this->coordinator = $coordinator;
    }

    /**
     * @inheritdoc
     */
    public function getDefinition()
    {
        return $this->coordinator->getDefinition();
    }

    /**
     * @inheritdoc
     */
    public function getStateObject($name)
    {
        return $this->coordinator->getStateObject($name);
    }

    /**
     * @inheritdoc
     */
    public function getAllowedTransitions(StateInterface $state, $context)
    {
        return $this->coordinator->getAllowedTransitions($state, $context);
    }

    /**
     * @inheritdoc
     */
    public function complete(
        TransitionInterface $transition,
        $context,
        $data = null
    ) {
        return $this->coordinator->complete($transition, $context, $data);
    }

    /**
     * @inheritdoc
     */
    public function isCompleted()
    {
        return $this->coordinator->isCompleted();
    }
}

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
use PMD\StateMachineBundle\Process\TokenInterface;
use PMD\StateMachineBundle\StateMachineInterface;

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
    public function getState($name)
    {
        return $this->coordinator->getState($name);
    }

    /**
     * @inheritdoc
     */
    public function getTokens(StateMachineInterface $instance, $context)
    {
        return $this->coordinator->getTokens($instance, $context);
    }

    /**
     * @inheritdoc
     */
    public function consume(TokenInterface $token, $data = null)
    {
        return $this->coordinator->consume($token, $data);
    }
}

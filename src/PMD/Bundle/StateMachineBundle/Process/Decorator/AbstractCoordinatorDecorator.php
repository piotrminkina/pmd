<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Process\Decorator;

use Symfony\Component\HttpFoundation\Request;
use PMD\Bundle\StateMachineBundle\Process\CoordinatorInterface;
use PMD\Bundle\StateMachineBundle\Process\TokenInterface;
use PMD\Bundle\StateMachineBundle\StateMachineInterface;

/**
 * Class AbstractCoordinatorDecorator
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Process\Decorator
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
    public function consume(TokenInterface $token, Request $request)
    {
        return $this->coordinator->consume($token, $request);
    }
}

<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Process;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use PMD\Bundle\StateMachineBundle\Process\Definition\StateInterface;
use PMD\Bundle\StateMachineBundle\StateMachineInterface;

/**
 * Interface CoordinatorInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Process
 */
interface CoordinatorInterface
{
    /**
     * @return DefinitionInterface
     */
    public function getDefinition();

    /**
     * @param string $name
     * @return StateInterface
     */
    public function getState($name);

    /**
     * @param StateMachineInterface $instance
     * @param mixed $context
     * @return TokenInterface[]
     */
    public function getTokens(StateMachineInterface $instance, $context);

    /**
     * @param TokenInterface $token
     * @param Request $request
     * @return Response|mixed
     */
    public function consume(TokenInterface $token, Request $request);
}

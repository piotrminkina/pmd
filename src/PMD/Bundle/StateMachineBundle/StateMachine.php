<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle;

use Symfony\Component\HttpFoundation\Request;
use PMD\StateMachineBundle\Process\Definition\StateInterface;
use PMD\StateMachineBundle\Process\CoordinatorInterface;
use PMD\StateMachineBundle\Process\TokenInterface;
use PMD\StateMachineBundle\Model\ContextualInterface;
use PMD\StateMachineBundle\Model\StatefulInterface;

/**
 * Class StateMachine
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle
 */
class StateMachine implements StateMachineInterface
{
    /**
     * @var StatefulInterface
     */
    protected $object;

    /**
     * @var CoordinatorInterface
     */
    protected $coordinator;

    /**
     * @var StateInterface
     */
    protected $state;

    /**
     * @var mixed
     */
    protected $context;

    /**
     * @var TokenInterface[]
     */
    protected $tokens;

    /**
     * @param StatefulInterface $object
     * @param CoordinatorInterface $coordinator
     */
    public function __construct(
        StatefulInterface $object,
        CoordinatorInterface $coordinator
    ) {
        $this->object = $object;
        $this->coordinator = $coordinator;

        $this->updateMachine($object);
    }

    /**
     * @inheritdoc
     */
    public function getState()
    {
        return $this->state;
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
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * @inheritdoc
     */
    public function hasToken($name)
    {
        return isset($this->tokens[$name]);
    }

    /**
     * @inheritdoc
     */
    public function applyToken($name, Request $request)
    {
        if (!isset($this->tokens[$name])) {
            throw new \Exception(
                sprintf('Cannot flow by %s, because token of this name doesn\'t exits', $name)
            );
        }
        $token = $this->tokens[$name];
        $response = $this->coordinator->consume($token, $request);

        if ($token->isConsumed()) {
            $state = $token->getTargetState();
            $this->updateObject($state);
            $this->updateMachine($this->object);
        }

        return $response;
    }

    /**
     * @param StateInterface $state
     */
    protected function updateObject(StateInterface $state)
    {
        $this->object->setState($state->getName());
    }

    /**
     * @param StatefulInterface $object
     */
    protected function updateMachine(StatefulInterface $object)
    {
        $state = $object->getState();
        $coordinator = $this->coordinator;

        if ($object instanceof ContextualInterface) {
            $this->context = $object->getContext();
        } else {
            $this->context = $object;
        }

        $this->state = $coordinator->getState($state);
        $this->tokens = $coordinator->getTokens($this, $this->context);
    }
}

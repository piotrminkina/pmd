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

use Symfony\Component\HttpFoundation\Request;
use PMD\StateMachineBundle\Action\AbstractTokenAction;
use PMD\StateMachineBundle\Action\RegistryInterface;
use PMD\StateMachineBundle\Process\CoordinatorInterface;
use PMD\StateMachineBundle\Process\TokenInterface;

/**
 * Class ActionCoordinatorDecorator
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Process\Decorator
 */
class ActionCoordinatorDecorator extends AbstractCoordinatorDecorator
{
    /**
     * @var RegistryInterface|AbstractTokenAction[]
     */
    protected $registry;

    /**
     * @param CoordinatorInterface $coordinator
     * @param RegistryInterface|AbstractTokenAction[] $registry
     */
    public function __construct(
        CoordinatorInterface $coordinator,
        RegistryInterface $registry
    ) {
        parent::__construct($coordinator);

        $this->registry = $registry;
    }


    /**
     * @inheritdoc
     */
    public function consume(TokenInterface $token, Request $request)
    {
        foreach ($this->registry as $action) {
            $result = $action->execute($token, $request);

            if ($result !== null) {
                return $result;
            }
        }

        return parent::consume($token, $request);
    }
}

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
use PMD\Bundle\StateMachineBundle\Action\AbstractTokenAction;
use PMD\Bundle\StateMachineBundle\Action\RegistryInterface;
use PMD\Bundle\StateMachineBundle\Process\CoordinatorInterface;
use PMD\Bundle\StateMachineBundle\Process\TokenInterface;

/**
 * Class ActionCoordinatorDecorator
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Process\Decorator
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

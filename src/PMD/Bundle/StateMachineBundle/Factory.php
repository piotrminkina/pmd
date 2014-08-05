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

use PMD\StateMachineBundle\Process\CoordinatorInterface;
use PMD\StateMachineBundle\Process\RegistryInterface;
use PMD\StateMachineBundle\Model\StatefulInterface;

/**
 * Class Factory
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle
 */
class Factory implements FactoryInterface
{
    /**
     * @var RegistryInterface
     */
    protected $registry;

    /**
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @inheritdoc
     */
    public function create($name, StatefulInterface $object)
    {
        $coordinator = $this->getCoordinator($name);
        $stateMachine = new StateMachine($object, $coordinator);

        return $stateMachine;
    }

    /**
     * @param string $name
     * @throws \Exception
     * @return CoordinatorInterface
     */
    protected function getCoordinator($name)
    {
        if (!$this->registry->hasCoordinator($name)) {
            throw new \Exception(
                sprintf(
                    'Cannot create State Machine, because coordinator named "%s" is unknown',
                    $name
                )
            );
        }

        return $this->registry->getCoordinator($name);
    }
}

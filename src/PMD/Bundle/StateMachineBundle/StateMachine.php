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

/**
 * Class StateMachine
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle
 */
class StateMachine extends AbstractStateMachine
{
    /**
     * @return StateMachineCoordinatorInterface
     */
    protected function createCoordinator()
    {
        return new StateMachineCoordinator($this);
    }
}

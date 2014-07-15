<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Definition\Factory;

use PMD\StateMachineBundle\Definition\DefinitionInterface;
use PMD\StateMachineBundle\Definition\StateInterface;
use PMD\StateMachineBundle\Definition\TransitionInterface;

/**
 * Interface DefinitionFactoryInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Definition\Factory
 */
interface DefinitionFactoryInterface
{
    /**
     * @return DefinitionInterface
     */
    public function createDefinition();

    /**
     * @return StateInterface
     */
    public function createState();

    /**
     * @return TransitionInterface
     */
    public function createTransition();
}

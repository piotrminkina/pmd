<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Process\Factory;

use PMD\StateMachineBundle\Process\Definition\StateInterface;
use PMD\StateMachineBundle\Process\Definition\TransitionInterface;
use PMD\StateMachineBundle\Process\DefinitionInterface;

/**
 * Interface DefinitionFactoryInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Process\Factory
 */
interface DefinitionFactoryInterface
{
    /**
     * @param string $name
     * @return DefinitionInterface
     */
    public function createDefinition($name);

    /**
     * @param string $name
     * @return StateInterface
     */
    public function createState($name);

    /**
     * @param string $name
     * @return TransitionInterface
     */
    public function createTransition($name);
}

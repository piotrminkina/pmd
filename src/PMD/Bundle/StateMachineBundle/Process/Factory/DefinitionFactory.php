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

use PMD\StateMachineBundle\Process\Definition\State;
use PMD\StateMachineBundle\Process\Definition\Transition;
use PMD\StateMachineBundle\Process\Definition;

/**
 * Class DefinitionFactory
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Process\Factory
 */
class DefinitionFactory implements DefinitionFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createDefinition($name)
    {
        $type = new Definition();
        $type->setName($name);

        return $type;
    }

    /**
     * @inheritdoc
     */
    public function createState($name)
    {
        $type = new State();
        $type->setName($name);

        return $type;
    }

    /**
     * @inheritdoc
     */
    public function createTransition($name)
    {
        $type = new Transition();
        $type->setName($name);

        return $type;
    }
}

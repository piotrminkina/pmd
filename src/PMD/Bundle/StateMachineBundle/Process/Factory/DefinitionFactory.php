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

use PMD\StateMachineBundle\Process\Definition;
use PMD\StateMachineBundle\Process\Transition;
use PMD\StateMachineBundle\Process\State;

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
    public function createTransition($name, $label)
    {
        $type = new Transition();
        $type->setName($name);
        $type->setLabel($label);

        return $type;
    }
}

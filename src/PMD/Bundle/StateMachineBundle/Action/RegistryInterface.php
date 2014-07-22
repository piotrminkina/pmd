<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Action;

/**
 * Interface RegistryInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Action
 */
interface RegistryInterface extends \IteratorAggregate
{
    /**
     * @param string $name
     * @return AbstractTokenAction
     */
    public function getAction($name);

    /**
     * @param string $name
     * @return boolean
     */
    public function hasAction($name);
}

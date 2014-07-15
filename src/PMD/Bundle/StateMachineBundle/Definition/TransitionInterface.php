<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\Definition;

/**
 * Interface TransitionInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\Definition
 */
interface TransitionInterface
{
    /**
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $source
     * @return $this
     */
    public function setSource($source);

    /**
     * @return string
     */
    public function getSource();

    /**
     * @param string $target
     * @return $this
     */
    public function setTarget($target);

    /**
     * @return string
     */
    public function getTarget();
}

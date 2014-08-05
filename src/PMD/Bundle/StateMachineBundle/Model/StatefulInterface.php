<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\Model;

/**
 * Interface StatefulInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\Model
 */
interface StatefulInterface
{
    /**
     * @param string $state
     * @return $this
     */
    public function setState($state);

    /**
     * @return string
     */
    public function getState();
}

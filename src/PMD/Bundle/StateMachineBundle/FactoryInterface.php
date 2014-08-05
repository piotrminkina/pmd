<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle;

use PMD\Bundle\StateMachineBundle\Model\StatefulInterface;

/**
 * Interface FactoryInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle
 */
interface FactoryInterface
{
    /**
     * @param string $name
     * @param StatefulInterface $object
     * @return StateMachineInterface
     */
    public function create($name, StatefulInterface $object);
}

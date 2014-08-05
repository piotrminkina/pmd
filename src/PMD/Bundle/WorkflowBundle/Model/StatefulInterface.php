<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\Model;

/**
 * Class StatefulInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Model
 */
interface StatefulInterface
{
    /**
     * @return string
     */
    public function getState();

    /**
     * @param string $name
     * @return StatefulInterface
     */
    public function setState($name);
}

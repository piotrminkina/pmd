<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\WorkflowBundle\WorkList\Handler;

use PMD\Bundle\WorkflowBundle\WorkList\WorkListInterface;

/**
 * A software component that manages the interaction between the user (or
 * group of users) and the work list maintained by a workflow engine.
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\WorkflowBundle\WorkList\Handler
 */
interface WorkListHandlerInterface
{
    /**
     * @param WorkListInterface $workList
     * @return WorkListHandlerInterface
     */
    public function setWorkList(WorkListInterface $workList);

    /**
     * @return WorkListInterface
     */
    public function getWorkList();
}

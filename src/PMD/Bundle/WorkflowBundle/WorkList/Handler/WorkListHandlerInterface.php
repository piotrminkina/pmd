<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\WorkList\Handler;

use PMD\WorkflowBundle\WorkList\WorkListInterface;

/**
 * A software component that manages the interaction between the user (or
 * group of users) and the work list maintained by a workflow engine.
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\WorkList\Handler
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

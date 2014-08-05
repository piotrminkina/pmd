<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\WorkflowBundle\WorkList;

use Doctrine\Common\Collections\Collection;
use PMD\Bundle\WorkflowBundle\WorkItem\WorkItemInterface;

/**
 * A list of work items associated with a given workflow participant.
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\WorkflowBundle\WorkList
 */
interface WorkListInterface
{
    /**
     * @param Collection|WorkItemInterface[] $workItems
     * @return WorkListInterface
     */
    public function setWorkItems(Collection $workItems);

    /**
     * @param WorkItemInterface $workItem
     * @return WorkListInterface
     */
    public function addWorkItem(WorkItemInterface $workItem);

    /**
     * @return Collection|WorkItemInterface[]
     */
    public function getWorkItems();
}

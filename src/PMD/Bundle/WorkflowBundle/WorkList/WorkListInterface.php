<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\WorkList;

use Doctrine\Common\Collections\Collection;
use PMD\WorkflowBundle\WorkList\Item\WorkListItemInterface;

/**
 * A list of work items associated with a given workflow participant.
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\WorkList
 */
interface WorkListInterface
{
    /**
     * @param Collection|WorkListItemInterface[] $workListItems
     * @return WorkListInterface
     */
    public function setWorkListItems(Collection $workListItems);

    /**
     * @param WorkListItemInterface $workListItem
     * @return WorkListInterface
     */
    public function addWorkListItem(WorkListItemInterface $workListItem);

    /**
     * @return Collection|WorkListItemInterface[]
     */
    public function getWorkListItems();
}

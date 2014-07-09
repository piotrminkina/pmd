<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\Definition;

use Doctrine\Common\Collections\Collection;

/**
 * Interface DefinitionInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Definition
 */
interface DefinitionInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param Collection|ActivityInterface[] $activities
     * @return DefinitionInterface
     */
    public function setActivities(Collection $activities);

    /**
     * @param ActivityInterface $activity
     * @return DefinitionInterface
     */
    public function addActivity(ActivityInterface $activity);

    /**
     * @return Collection|ActivityInterface[]
     */
    public function getActivities();
}

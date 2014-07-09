<?php

/*
 * This file is part of the PMDWorkflowBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\WorkflowBundle\Definition\Builder;

use PMD\WorkflowBundle\Definition\ActivityInterface;
use PMD\WorkflowBundle\Definition\DefinitionInterface;

/**
 * Interface DefinitionBuilderInterface
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\WorkflowBundle\Definition\Builder
 */
interface DefinitionBuilderInterface
{
    /**
     * @return ActivityInterface
     */
    public function buildActivity();

    /**
     * @param ActivityInterface $source
     * @param ActivityInterface $target
     * @return DefinitionBuilderInterface
     */
    public function connectActivities(
        ActivityInterface $source,
        ActivityInterface $target
    );

    /**
     * @return DefinitionInterface
     */
    public function getDefinition();
}

<?php

namespace PMD\ResourcesResolverBundle\RequirementsCollector;

use PMD\ResourcesResolverBundle\Requirement\RequirementReadInterface;

/**
 * Interface RequirementsCollectorReadInterface
 * @package PMD\ResourcesResolverBundle\RequirementsCollector
 */
interface RequirementsCollectorReadInterface extends \IteratorAggregate
{
    /**
     * @return \Iterator|RequirementReadInterface[]
     */
    public function getIterator();
}

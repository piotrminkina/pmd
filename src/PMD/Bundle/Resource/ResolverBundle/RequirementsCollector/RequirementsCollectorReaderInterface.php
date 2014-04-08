<?php

namespace PMD\ResourcesResolverBundle\RequirementsCollector;

use PMD\ResourcesResolverBundle\Requirement\RequirementReaderInterface;

/**
 * Interface RequirementsCollectorReaderInterface
 * @package PMD\ResourcesResolverBundle\RequirementsCollector
 */
interface RequirementsCollectorReaderInterface extends \IteratorAggregate
{
    /**
     * @return \Iterator|RequirementReaderInterface[]
     */
    public function getIterator();
}

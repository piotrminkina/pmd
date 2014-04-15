<?php

namespace PMD\ResourcesResolverBundle\Collector;

use PMD\ResourcesResolverBundle\Requirement\RequirementReadInterface;

/**
 * Interface CollectorReadInterface
 * @package PMD\ResourcesResolverBundle\Collector
 */
interface CollectorReadInterface extends \IteratorAggregate
{
    /**
     * @return \Iterator|RequirementReadInterface[]
     */
    public function getIterator();
}

<?php

namespace PMD\ResourcesResolverBundle\Collector;

use PMD\ResourcesResolverBundle\Requirement\RequirementReadInterface;

/**
 * Interface CollectorInterface
 * @package PMD\ResourcesResolverBundle\Collector
 */
interface CollectorInterface
{
    /**
     * @return RequirementReadInterface[]
     */
    public function collect();
}

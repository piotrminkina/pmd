<?php

namespace PMD\ResourcesResolverBundle\Collector;

/**
 * Interface CollectorInterface
 * @package PMD\ResourcesResolverBundle\Collector
 */
interface CollectorInterface extends CollectorReadInterface
{
    /**
     */
    public function collectRequirements();
}

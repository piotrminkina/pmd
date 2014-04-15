<?php

namespace PMD\ResourcesResolverBundle\RequirementsCollector;

/**
 * Interface RequirementsCollectorInterface
 * @package PMD\ResourcesResolverBundle\RequirementsCollector
 */
interface RequirementsCollectorInterface extends RequirementsCollectorReadInterface
{
    /**
     */
    public function collectRequirements();
}

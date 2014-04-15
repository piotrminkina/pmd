<?php

namespace PMD\ResourcesResolverBundle\Resolver;

use PMD\ResourcesResolverBundle\Exception\ResourceNotFoundException;
use PMD\ResourcesResolverBundle\RequirementsCollector\RequirementsCollectorReadInterface;
use PMD\ResourcesResolverBundle\Injector\InjectorInterface;

/**
 * Interface ResolverInterface
 * @package PMD\ResourcesResolverBundle\Resolver
 */
interface ResolverInterface
{
    /**
     * @param RequirementsCollectorReadInterface $collector
     * @return array
     * @throws ResourceNotFoundException
     */
    public function resolve(RequirementsCollectorReadInterface $collector);

    /**
     * @param RequirementsCollectorReadInterface $collector
     * @param InjectorInterface $injector
     * @return array
     * @throws ResourceNotFoundException
     */
    public function resolveAndInject(
        RequirementsCollectorReadInterface $collector,
        InjectorInterface $injector
    );
}

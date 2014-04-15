<?php

namespace PMD\ResourcesResolverBundle\Resolver;

use PMD\ResourcesResolverBundle\Exception\ResourceNotFoundException;
use PMD\ResourcesResolverBundle\Collector\CollectorReadInterface;
use PMD\ResourcesResolverBundle\Injector\InjectorInterface;

/**
 * Interface ResolverInterface
 * @package PMD\ResourcesResolverBundle\Resolver
 */
interface ResolverInterface
{
    /**
     * @param CollectorReadInterface $collector
     * @return array
     * @throws ResourceNotFoundException
     */
    public function resolve(CollectorReadInterface $collector);

    /**
     * @param CollectorReadInterface $collector
     * @param InjectorInterface $injector
     * @return array
     * @throws ResourceNotFoundException
     */
    public function resolveAndInject(
        CollectorReadInterface $collector,
        InjectorInterface $injector
    );
}

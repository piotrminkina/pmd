<?php

namespace PMD\ResourcesResolverBundle\Resolver;

use PMD\ResourcesResolverBundle\Collector\CollectorInterface;
use PMD\ResourcesResolverBundle\Exception\ResourceNotFoundException;
use PMD\ResourcesResolverBundle\Injector\InjectorInterface;

/**
 * Interface ResolverInterface
 * @package PMD\ResourcesResolverBundle\Resolver
 */
interface ResolverInterface
{
    /**
     * @param CollectorInterface $collector
     * @return array
     * @throws ResourceNotFoundException
     */
    public function resolve(CollectorInterface $collector);

    /**
     * @param CollectorInterface $collector
     * @param InjectorInterface $injector
     * @return array
     * @throws ResourceNotFoundException
     */
    public function resolveAndInject(
        CollectorInterface $collector,
        InjectorInterface $injector
    );
}

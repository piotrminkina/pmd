<?php

namespace PMD\ResourcesResolverBundle\Resolver;

use PMD\ResourcesResolverBundle\Exception\ResourceNotFoundException;
use PMD\ResourcesResolverBundle\RequirementsCollector\RequirementsCollectorReaderInterface;
use PMD\ResourcesResolverBundle\Injector\InjectorInterface;

/**
 * Interface ResolverInterface
 * @package PMD\ResourcesResolverBundle\Resolver
 */
interface ResolverInterface
{
    /**
     * @param RequirementsCollectorReaderInterface $collector
     * @return array
     * @throws ResourceNotFoundException
     */
    public function resolve(RequirementsCollectorReaderInterface $collector);

    /**
     * @param RequirementsCollectorReaderInterface $collector
     * @param InjectorInterface $injector
     * @return array
     * @throws ResourceNotFoundException
     */
    public function resolveAndInject(
        RequirementsCollectorReaderInterface $collector,
        InjectorInterface $injector
    );
}

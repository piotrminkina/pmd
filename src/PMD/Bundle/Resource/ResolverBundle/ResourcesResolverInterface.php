<?php

namespace PMD\ResourcesResolverBundle;

use PMD\ResourcesResolverBundle\Exception\ResourceNotFoundException;
use PMD\ResourcesResolverBundle\RequirementsCollector\RequirementsCollectorReaderInterface;
use PMD\ResourcesResolverBundle\Injector\InjectorInterface;

/**
 * Interface ResourcesResolverInterface
 * @package PMD\ResourcesResolverBundle
 */
interface ResourcesResolverInterface
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

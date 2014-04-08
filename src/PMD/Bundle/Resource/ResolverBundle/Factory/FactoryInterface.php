<?php

namespace PMD\ResourcesResolverBundle\Factory;

use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\RequirementsCollector\RequirementsCollectorReaderInterface;
use PMD\ResourcesResolverBundle\ResourcesInjector\ResourcesInjectorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface FactoryInterface
 * @package PMD\ResourcesResolverBundle\RequirementsCollector
 */
interface FactoryInterface
{
    /**
     * @param callback $callback
     * @return RequirementsCollectorReaderInterface
     * @throws InvalidArgumentException
     */
    public function createRequirementsCollector($callback);

    /**
     * @param Request $request
     * @return ResourcesInjectorInterface
     */
    public function createResourcesInjector(Request $request);
}

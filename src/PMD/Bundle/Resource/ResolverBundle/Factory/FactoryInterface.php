<?php

namespace PMD\ResourcesResolverBundle\Factory;

use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\RequirementsCollector\RequirementsCollectorReaderInterface;
use PMD\ResourcesResolverBundle\Injector\InjectorInterface;
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
     * @return InjectorInterface
     */
    public function createInjector(Request $request);
}

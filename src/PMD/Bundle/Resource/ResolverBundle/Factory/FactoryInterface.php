<?php

namespace PMD\ResourcesResolverBundle\Factory;

use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\Collector\CollectorInterface;
use PMD\ResourcesResolverBundle\Injector\InjectorInterface;

/**
 * Interface FactoryInterface
 * @package PMD\ResourcesResolverBundle\Collector
 */
interface FactoryInterface
{
    /**
     * @return CollectorInterface
     * @throws InvalidArgumentException
     */
    public function createCollector();

    /**
     * @return InjectorInterface
     * @throws InvalidArgumentException
     */
    public function createInjector();
}

<?php

namespace PMD\ResourcesResolverBundle\Factory;

use PMD\ResourcesResolverBundle\Collector\CollectorInterface;
use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\Injector\InjectorInterface;
use PMD\ResourcesResolverBundle\Provider\ProviderInterface;
use PMD\ResourcesResolverBundle\Resolver\ResolverInterface;

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

    /**
     * @return ProviderInterface
     */
    public function createProvider();

    /**
     * @return ResolverInterface
     */
    public function createResolver();
}

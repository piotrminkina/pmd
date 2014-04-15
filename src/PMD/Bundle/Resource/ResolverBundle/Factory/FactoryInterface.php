<?php

namespace PMD\ResourcesResolverBundle\Factory;

use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\RequirementsCollector\RequirementsCollectorReaderInterface;
use PMD\ResourcesResolverBundle\Injector\InjectorInterface;

/**
 * Interface FactoryInterface
 * @package PMD\ResourcesResolverBundle\RequirementsCollector
 */
interface FactoryInterface
{
    /**
     * @return RequirementsCollectorReaderInterface
     * @throws InvalidArgumentException
     */
    public function createCollector();

    /**
     * @return InjectorInterface
     * @throws InvalidArgumentException
     */
    public function createInjector();
}

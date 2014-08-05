<?php

/*
 * This file is part of the PMDResourcesResolverBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\ResourcesResolverBundle\Resolver;

use PMD\ResourcesResolverBundle\Collector\CollectorInterface;
use PMD\ResourcesResolverBundle\Exception\ResourceNotFoundException;
use PMD\ResourcesResolverBundle\Injector\InjectorInterface;

/**
 * Interface ResolverInterface
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
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

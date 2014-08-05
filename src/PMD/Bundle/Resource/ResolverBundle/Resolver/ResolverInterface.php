<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\Resource\ResolverBundle\Resolver;

use PMD\Bundle\Resource\ResolverBundle\Collector\CollectorInterface;
use PMD\Bundle\Resource\ResolverBundle\Exception\ResourceNotFoundException;
use PMD\Bundle\Resource\ResolverBundle\Injector\InjectorInterface;

/**
 * Interface ResolverInterface
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Resolver
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

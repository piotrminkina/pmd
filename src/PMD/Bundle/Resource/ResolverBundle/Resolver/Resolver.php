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
use PMD\ResourcesResolverBundle\Provider\ProviderReadInterface;

/**
 * Class Resolver
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\ResourcesResolverBundle\Resolver
 */
class Resolver implements ResolverInterface
{
    /**
     * @var ProviderReadInterface
     */
    protected $provider;

    /**
     * @param ProviderReadInterface $provider
     */
    public function __construct(ProviderReadInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @inheritdoc
     */
    public function resolve(CollectorInterface $collector)
    {
        $resources = array();

        foreach ($collector->collect() as $resourceName => $requirement) {
            $resolvedName = $requirement->getResolvedName();

            if ($this->provider->has($resourceName)) {
                $resource = $this->provider->get($resourceName);
                $resources[$resolvedName] = $resource;
            } elseif (!$requirement->isOptional()) {
                throw new ResourceNotFoundException(
                    sprintf('Cannot resolve resource with name %s', $resourceName)
                );
            }
        }

        return $resources;
    }

    /**
     * @inheritdoc
     */
    public function resolveAndInject(
        CollectorInterface $collector,
        InjectorInterface $injector
    ) {
        $resources = $this->resolve($collector);

        foreach ($resources as $resolvedName => $resource) {
            $injector->inject($resolvedName, $resource);
        }

        return $resources;
    }
}

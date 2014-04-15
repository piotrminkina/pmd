<?php

namespace PMD\ResourcesResolverBundle\Resolver;

use PMD\ResourcesResolverBundle\Exception\ResourceNotFoundException;
use PMD\ResourcesResolverBundle\Requirement\RequirementReadInterface;
use PMD\ResourcesResolverBundle\RequirementsCollector\RequirementsCollectorReadInterface;
use PMD\ResourcesResolverBundle\Injector\InjectorInterface;
use PMD\ResourcesResolverBundle\Provider\ProviderReadInterface;

/**
 * Class Resolver
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
    public function resolve(RequirementsCollectorReadInterface $collector)
    {
        $resources = array();

        /** @var RequirementReadInterface[] $collector */
        foreach ($collector as $resourceName => $requirement) {
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
        RequirementsCollectorReadInterface $collector,
        InjectorInterface $injector
    ) {
        $resources = $this->resolve($collector);

        foreach ($resources as $resolvedName => $resource) {
            $injector->inject($resolvedName, $resource);
        }

        return $resources;
    }
}

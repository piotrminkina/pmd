<?php

namespace PMD\ResourcesResolverBundle;

use PMD\ResourcesResolverBundle\Exception\ResourceNotFoundException;
use PMD\ResourcesResolverBundle\Requirement\RequirementReaderInterface;
use PMD\ResourcesResolverBundle\RequirementsCollector\RequirementsCollectorReaderInterface;
use PMD\ResourcesResolverBundle\ResourcesInjector\ResourcesInjectorInterface;
use PMD\ResourcesResolverBundle\ResourcesProvider\ResourcesProviderReaderInterface;

/**
 * Class ResourcesResolver
 * @package PMD\ResourcesResolverBundle
 */
class ResourcesResolver implements ResourcesResolverInterface
{
    /**
     * @var ResourcesProviderReaderInterface
     */
    protected $provider;

    /**
     * @param ResourcesProviderReaderInterface $provider
     */
    public function __construct(ResourcesProviderReaderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @inheritdoc
     */
    public function resolve(RequirementsCollectorReaderInterface $collector)
    {
        $resources = array();

        /** @var RequirementReaderInterface[] $collector */
        foreach ($collector as $resourceName => $requirement) {
            $resolvedName = $requirement->getResolvedName();

            if ($this->provider->hasResource($resourceName)) {
                $resource = $this->provider->getResource($resourceName);
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
        RequirementsCollectorReaderInterface $collector,
        ResourcesInjectorInterface $injector
    ) {
        $resources = $this->resolve($collector);

        foreach ($resources as $resolvedName => $resource) {
            $injector->inject($resolvedName, $resource);
        }
    }
}

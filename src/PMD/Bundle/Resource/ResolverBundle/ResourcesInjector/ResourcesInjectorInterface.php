<?php

namespace PMD\ResourcesResolverBundle\ResourcesInjector;

/**
 * Interface ResourcesInjectorInterface
 * @package PMD\ResourcesResolverBundle\ResourcesInjector
 */
interface ResourcesInjectorInterface
{
    /**
     * @param string $name
     * @param mixed $resource
     */
    public function inject($name, $resource);
}

<?php

namespace PMD\ResourcesResolverBundle\Injector;

/**
 * Interface InjectorInterface
 * @package PMD\ResourcesResolverBundle\Injector
 */
interface InjectorInterface
{
    /**
     * @param string $name
     * @param mixed $resource
     */
    public function inject($name, $resource);
}

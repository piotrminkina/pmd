<?php

namespace PMD\ResourcesResolverBundle\Provider;

/**
 * Interface ProviderReadInterface
 * @package PMD\ResourcesResolverBundle\Provider
 */
interface ProviderReadInterface
{
    /**
     * @param string $name
     * @return bool
     */
    public function has($name);

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name);
}

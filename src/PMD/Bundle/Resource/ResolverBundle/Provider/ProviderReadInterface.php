<?php

namespace PMD\ResourcesResolverBundle\Provider;

use PMD\ResourcesResolverBundle\Exception\NotFoundException;

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
     * @throws NotFoundException
     */
    public function get($name);
}

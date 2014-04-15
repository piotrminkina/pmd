<?php

namespace PMD\ResourcesResolverBundle\Provider;

/**
 * Interface ProviderWriteInterface
 * @package PMD\ResourcesResolverBundle\Provider
 */
interface ProviderWriteInterface
{
    /**
     * @param string $name
     * @param mixed $resource
     * @return $this
     */
    public function set($name, $resource);

    /**
     * @param string $name
     * @param mixed $resource
     * @return $this
     */
    public function add($name, $resource);

    /**
     * @param string $name
     * @param mixed $resource
     * @return $this
     */
    public function replace($name, $resource);

    /**
     * @param string $name
     * @return $this
     */
    public function remove($name);
}

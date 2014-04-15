<?php

namespace PMD\ResourcesResolverBundle\Provider;

use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\Exception\NotFoundException;

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
     * @throws InvalidArgumentException
     */
    public function add($name, $resource);

    /**
     * @param string $name
     * @param mixed $resource
     * @return $this
     * @throws NotFoundException
     */
    public function replace($name, $resource);

    /**
     * @param string $name
     * @return $this
     */
    public function remove($name);
}

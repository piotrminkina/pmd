<?php

namespace PMD\ResourcesResolverBundle\ResourcesProvider;

/**
 * Interface ResourcesProviderWriterInterface
 * @package PMD\ResourcesResolverBundle\ResourcesProvider
 */
interface ResourcesProviderWriterInterface
{
    /**
     * @param string $name
     * @param mixed $parameter
     * @return $this
     */
    public function setParameter($name, $parameter);

    /**
     * @param string $name
     * @param mixed $parameter
     * @return $this
     */
    public function addParameter($name, $parameter);

    /**
     * @param string $name
     * @param mixed $parameter
     * @return $this
     */
    public function replaceParameter($name, $parameter);

    /**
     * @param string $name
     * @return $this
     */
    public function removeParameter($name);

    /**
     * @param string $name
     * @param mixed $resource
     * @return $this
     */
    public function setResource($name, $resource);

    /**
     * @param string $name
     * @param mixed $resource
     * @return $this
     */
    public function addResource($name, $resource);

    /**
     * @param string $name
     * @param mixed $resource
     * @return $this
     */
    public function replaceResource($name, $resource);

    /**
     * @param string $name
     * @return $this
     */
    public function removeResource($name);
}

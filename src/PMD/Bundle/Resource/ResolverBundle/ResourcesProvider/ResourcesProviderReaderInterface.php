<?php

namespace PMD\ResourcesResolverBundle\ResourcesProvider;

/**
 * Interface ResourcesProviderReaderInterface
 * @package PMD\ResourcesResolverBundle\ResourcesProvider
 */
interface ResourcesProviderReaderInterface
{
    /**
     * @param string $name
     * @return bool
     */
    public function hasParameter($name);

    /**
     * @param string $name
     * @return mixed
     */
    public function getParameter($name);

    /**
     * @param string $name
     * @return bool
     */
    public function hasResource($name);

    /**
     * @param string $name
     * @return mixed
     */
    public function getResource($name);
}

<?php

namespace PMD\ResourcesResolverBundle\ResourcesProvider;

/**
 * Class ResourcesProvider
 * @package PMD\ResourcesResolverBundle\ResourcesProvider
 */
class ResourcesProvider implements ResourcesProviderInterface
{
    /**
     * @inheritdoc
     */
    public function hasParameter($name)
    {
        // TODO: Implement hasParameter() method.
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getParameter($name)
    {
        // TODO: Implement getParameter() method.
        return '';
    }

    /**
     * @inheritdoc
     */
    public function hasResource($name)
    {
        // TODO: Implement hasResource() method.
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getResource($name)
    {
        // TODO: Implement getResource() method.
        return null;
    }

    /**
     * @inheritdoc
     */
    public function setParameter($name, $parameter)
    {
        // TODO: Implement setParameter() method.
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addParameter($name, $parameter)
    {
        // TODO: Implement addParameter() method.
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function replaceParameter($name, $parameter)
    {
        // TODO: Implement replaceParameter() method.
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeParameter($name)
    {
        // TODO: Implement removeParameter() method.
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setResource($name, $resource)
    {
        // TODO: Implement setResource() method.
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addResource($name, $resource)
    {
        // TODO: Implement addResource() method.
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function replaceResource($name, $resource)
    {
        // TODO: Implement replaceResource() method.
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeResource($name)
    {
        // TODO: Implement removeResource() method.
        return $this;
    }
}

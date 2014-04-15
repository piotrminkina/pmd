<?php

namespace PMD\ResourcesResolverBundle\Provider;

/**
 * Class Provider
 * @package PMD\ResourcesResolverBundle\Provider
 */
class Provider implements ProviderInterface
{
    /**
     * @inheritdoc
     */
    public function has($name)
    {
        // TODO: Implement has() method.
        return true;
    }

    /**
     * @inheritdoc
     */
    public function get($name)
    {
        // TODO: Implement get() method.
        return null;
    }

    /**
     * @inheritdoc
     */
    public function set($name, $resource)
    {
        // TODO: Implement set() method.
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function add($name, $resource)
    {
        // TODO: Implement add() method.
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function replace($name, $resource)
    {
        // TODO: Implement replace() method.
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function remove($name)
    {
        // TODO: Implement remove() method.
        return $this;
    }
}

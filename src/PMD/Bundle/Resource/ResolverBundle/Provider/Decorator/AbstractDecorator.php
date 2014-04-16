<?php

namespace PMD\ResourcesResolverBundle\Provider\Decorator;

use PMD\ResourcesResolverBundle\Provider\ProviderInterface;

/**
 * Class AbstractDecorator
 * @package PMD\ResourcesResolverBundle\Provider\Decorator
 */
abstract class AbstractDecorator implements ProviderInterface
{
    /**
     * @var ProviderInterface
     */
    protected $provider;

    /**
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @inheritdoc
     */
    public function has($name)
    {
        return $this->provider->has($name);
    }

    /**
     * @inheritdoc
     */
    public function get($name)
    {
        return $this->provider->get($name);
    }

    /**
     * @inheritdoc
     */
    public function set($name, $resource)
    {
        return $this->provider->set($name, $resource);
    }

    /**
     * @inheritdoc
     */
    public function add($name, $resource)
    {
        return $this->provider->add($name, $resource);
    }

    /**
     * @inheritdoc
     */
    public function replace($name, $resource)
    {
        return $this->provider->replace($name, $resource);
    }

    /**
     * @inheritdoc
     */
    public function remove($name)
    {
        return $this->provider->remove($name);
    }
}

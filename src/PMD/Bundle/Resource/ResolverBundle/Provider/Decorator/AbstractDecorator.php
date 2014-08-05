<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\Resource\ResolverBundle\Provider\Decorator;

use PMD\Bundle\Resource\ResolverBundle\Provider\ProviderInterface;

/**
 * Class AbstractDecorator
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Provider\Decorator
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

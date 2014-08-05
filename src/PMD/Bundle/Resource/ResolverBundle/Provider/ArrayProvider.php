<?php

/*
 * This file is part of the PMDResourcesResolverBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\ResourcesResolverBundle\Provider;

use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\Exception\NotFoundException;

/**
 * Class ArrayProvider
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\ResourcesResolverBundle\Provider
 */
class ArrayProvider implements ProviderInterface
{
    /**
     * @var array
     */
    protected $resources;

    /**
     * @param array $resources
     */
    public function __construct(array $resources = array())
    {
        $this->resources = $resources;
    }

    /**
     * @inheritdoc
     */
    public function has($name)
    {
        return array_key_exists($name, $this->resources);
    }

    /**
     * @inheritdoc
     */
    public function get($name)
    {
        if (!$this->has($name)) {
            throw new NotFoundException(
                sprintf(
                    'Resource with name %name% not exists',
                    $name
                )
            );
        }

        return $this->resources[$name];
    }

    /**
     * @inheritdoc
     */
    public function set($name, $resource)
    {
        $this->resources[$name] = $resource;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function add($name, $resource)
    {
        if ($this->has($name)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Resource %name% cannot be added because another one exists',
                    $name
                )
            );
        }

        return $this->set($name, $resource);
    }

    /**
     * @inheritdoc
     */
    public function replace($name, $resource)
    {
        if (!$this->has($name)) {
            throw new NotFoundException(
                sprintf(
                    'Resource %name% cannot be replaced because not exists',
                    $name
                )
            );
        }

        return $this->set($name, $resource);
    }

    /**
     * @inheritdoc
     */
    public function remove($name)
    {
        unset($this->resources[$name]);

        return $this;
    }
}

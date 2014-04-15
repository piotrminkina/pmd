<?php

namespace PMD\ResourcesResolverBundle\Provider;

use Symfony\Component\HttpFoundation\Request;
use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\Exception\NotFoundException;

/**
 * Class RequestProvider
 * @package PMD\ResourcesResolverBundle\Provider
 */
class RequestProvider implements ProviderInterface
{
    /**
     * @var array
     */
    protected $resources;

    /**
     * @param Request $request
     * @param string $storageKey
     */
    public function __construct(Request $request, $storageKey = '_resources')
    {
        if ($request->attributes->has($storageKey)) {
            $this->resources = $request->attributes->get($storageKey);
        } else {
            $this->resources = array();
        }
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

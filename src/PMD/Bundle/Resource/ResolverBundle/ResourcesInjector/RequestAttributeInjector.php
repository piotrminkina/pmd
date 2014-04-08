<?php

namespace PMD\ResourcesResolverBundle\ResourcesInjector;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestAttributeInjector
 * @package PMD\ResourcesResolverBundle\ResourcesInjector
 */
class RequestAttributeInjector implements ResourcesInjectorInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @inheritdoc
     */
    public function inject($name, $resource)
    {
        $this->request->attributes->set($name, $resource);
    }
}

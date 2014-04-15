<?php

namespace PMD\ResourcesResolverBundle\Injector;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestAttributeInjector
 * @package PMD\ResourcesResolverBundle\Injector
 */
class RequestAttributeInjector implements InjectorInterface
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

<?php

namespace PMD\ResourcesResolverBundle\Provider;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestProvider
 * @package PMD\ResourcesResolverBundle\Provider
 */
class RequestProvider extends ArrayProvider
{
    /**
     * @param Request $request
     * @param string $storageKey
     */
    public function __construct(Request $request, $storageKey = '_resources')
    {
        if ($request->attributes->has($storageKey)) {
            $resources = $request->attributes->get($storageKey);
        } else {
            $resources = array();
        }

        parent::__construct($resources);
    }
}

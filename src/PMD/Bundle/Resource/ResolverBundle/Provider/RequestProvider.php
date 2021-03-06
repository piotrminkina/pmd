<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\Resource\ResolverBundle\Provider;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestProvider
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Provider
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

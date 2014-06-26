<?php

/*
 * This file is part of the PMDResourcesResolverBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\ResourcesResolverBundle\Injector;

/**
 * Interface InjectorInterface
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\ResourcesResolverBundle\Injector
 */
interface InjectorInterface
{
    /**
     * @param string $name
     * @param mixed $resource
     */
    public function inject($name, $resource);
}

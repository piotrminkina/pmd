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

use PMD\ResourcesResolverBundle\Exception\NotFoundException;

/**
 * Interface ProviderReadInterface
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\ResourcesResolverBundle\Provider
 */
interface ProviderReadInterface
{
    /**
     * @param string $name
     * @return bool
     */
    public function has($name);

    /**
     * @param string $name
     * @return mixed
     * @throws NotFoundException
     */
    public function get($name);
}

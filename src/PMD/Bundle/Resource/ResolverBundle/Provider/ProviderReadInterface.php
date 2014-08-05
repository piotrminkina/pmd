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

use PMD\Bundle\Resource\ResolverBundle\Exception\NotFoundException;

/**
 * Interface ProviderReadInterface
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Provider
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

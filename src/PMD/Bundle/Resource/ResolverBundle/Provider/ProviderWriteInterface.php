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

use PMD\Bundle\Resource\ResolverBundle\Exception\InvalidArgumentException;
use PMD\Bundle\Resource\ResolverBundle\Exception\NotFoundException;

/**
 * Interface ProviderWriteInterface
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Provider
 */
interface ProviderWriteInterface
{
    /**
     * @param string $name
     * @param mixed $resource
     * @return $this
     */
    public function set($name, $resource);

    /**
     * @param string $name
     * @param mixed $resource
     * @return $this
     * @throws InvalidArgumentException
     */
    public function add($name, $resource);

    /**
     * @param string $name
     * @param mixed $resource
     * @return $this
     * @throws NotFoundException
     */
    public function replace($name, $resource);

    /**
     * @param string $name
     * @return $this
     */
    public function remove($name);
}

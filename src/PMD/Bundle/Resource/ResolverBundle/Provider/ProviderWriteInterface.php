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
 * Interface ProviderWriteInterface
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\ResourcesResolverBundle\Provider
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

<?php

/*
 * This file is part of the PMDResourcesResolverBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\ResourcesResolverBundle\Factory;

use PMD\ResourcesResolverBundle\Collector\CollectorInterface;
use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\Injector\InjectorInterface;
use PMD\ResourcesResolverBundle\Parser\ParserInterface;
use PMD\ResourcesResolverBundle\Provider\ProviderInterface;
use PMD\ResourcesResolverBundle\Resolver\ResolverInterface;

/**
 * Interface FactoryInterface
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\ResourcesResolverBundle\Factory
 */
interface FactoryInterface
{
    /**
     * @return CollectorInterface
     * @throws InvalidArgumentException
     */
    public function createCollector();

    /**
     * @return InjectorInterface
     * @throws InvalidArgumentException
     */
    public function createInjector();

    /**
     * @return ProviderInterface
     */
    public function createProvider();

    /**
     * @return ParserInterface
     */
    public function createParser();

    /**
     * @return ResolverInterface
     */
    public function createResolver();
}

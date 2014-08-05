<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\Resource\ResolverBundle\Factory;

use PMD\Bundle\Resource\ResolverBundle\Collector\CollectorInterface;
use PMD\Bundle\Resource\ResolverBundle\Exception\InvalidArgumentException;
use PMD\Bundle\Resource\ResolverBundle\Injector\InjectorInterface;
use PMD\Bundle\Resource\ResolverBundle\Parser\ParserInterface;
use PMD\Bundle\Resource\ResolverBundle\Provider\ProviderInterface;
use PMD\Bundle\Resource\ResolverBundle\Resolver\ResolverInterface;

/**
 * Interface FactoryInterface
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Factory
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

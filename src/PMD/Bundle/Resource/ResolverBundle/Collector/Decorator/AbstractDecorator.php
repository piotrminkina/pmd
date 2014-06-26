<?php

/*
 * This file is part of the PMDResourcesResolverBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\ResourcesResolverBundle\Collector\Decorator;

use PMD\ResourcesResolverBundle\Collector\CollectorInterface;

/**
 * Class AbstractDecorator
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\ResourcesResolverBundle\Collector\Decorator
 */
abstract class AbstractDecorator implements CollectorInterface
{
    /**
     * @var CollectorInterface
     */
    protected $collector;

    /**
     * @param CollectorInterface $collector
     */
    public function __construct(CollectorInterface $collector)
    {
        $this->collector = $collector;
    }

    /**
     * @inheritdoc
     */
    public function collect()
    {
        return $this->collector->collect();
    }
}

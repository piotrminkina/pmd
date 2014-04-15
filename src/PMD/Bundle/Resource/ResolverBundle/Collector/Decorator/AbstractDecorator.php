<?php

namespace PMD\ResourcesResolverBundle\Collector\Decorator;

use PMD\ResourcesResolverBundle\Collector\CollectorInterface;

/**
 * Class AbstractDecorator
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

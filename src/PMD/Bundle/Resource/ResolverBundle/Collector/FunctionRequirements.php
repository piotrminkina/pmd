<?php

namespace PMD\ResourcesResolverBundle\Collector;

/**
 * Class FunctionRequirements
 * @package PMD\ResourcesResolverBundle\Collector
 */
class FunctionRequirements extends AbstractCallableRequirements
{
    /**
     * @param mixed $name
     */
    public function __construct($name)
    {
        parent::__construct(new \ReflectionFunction($name));
    }
}

<?php

namespace PMD\ResourcesResolverBundle\Collector;

/**
 * Class MethodRequirements
 * @package PMD\ResourcesResolverBundle\Collector
 */
class MethodRequirements extends AbstractCallableRequirements
{
    /**
     * @param mixed $class
     * @param string $name
     */
    public function __construct($class, $name)
    {
        parent::__construct(new \ReflectionMethod($class, $name));
    }
}

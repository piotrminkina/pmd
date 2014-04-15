<?php

namespace PMD\ResourcesResolverBundle\RequirementsCollector;

/**
 * Class MethodRequirementsCollector
 * @package PMD\ResourcesResolverBundle\RequirementsCollector
 */
class MethodRequirementsCollector extends AbstractCallableRequirementsCollector
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

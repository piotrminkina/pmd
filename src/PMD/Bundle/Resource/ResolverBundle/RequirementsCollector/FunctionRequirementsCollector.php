<?php

namespace PMD\ResourcesResolverBundle\RequirementsCollector;

/**
 * Class FunctionRequirementsCollector
 * @package PMD\ResourcesResolverBundle\RequirementsCollector
 */
class FunctionRequirementsCollector extends AbstractCallableRequirementsCollector
{
    /**
     * @param mixed $name
     */
    public function __construct($name)
    {
        parent::__construct(new \ReflectionFunction($name));
    }
}

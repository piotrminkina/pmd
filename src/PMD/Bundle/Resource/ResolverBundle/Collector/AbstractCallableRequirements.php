<?php

namespace PMD\ResourcesResolverBundle\Collector;

use PMD\ResourcesResolverBundle\Requirement\CallbackParameter;
use PMD\ResourcesResolverBundle\Requirement\RequirementInterface;

/**
 * Class AbstractCallableRequirements
 * @package PMD\ResourcesResolverBundle\Collector
 */
abstract class AbstractCallableRequirements implements CollectorInterface
{
    /**
     * @var \ReflectionFunctionAbstract
     */
    protected $reflection;

    /**
     */
    public function __construct(\ReflectionFunctionAbstract $reflection)
    {
        $this->reflection = $reflection;
    }
    
    /**
     * @inheritdoc
     */
    public function collect()
    {
        $requirements = array();

        foreach ($this->reflection->getParameters() as $parameter) {
            $requirement = $this->createRequirement($parameter);
            $resourceName = $requirement->getResourceName();

            $requirements[$resourceName] = $requirement;
        }

        return $requirements;
    }

    /**
     * @param \ReflectionParameter $parameter
     * @return RequirementInterface
     */
    protected function createRequirement(\ReflectionParameter $parameter)
    {
        return new CallbackParameter($parameter);
    }
}

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
     * @var RequirementInterface[]
     */
    protected $requirements;

    /**
     */
    public function __construct(\ReflectionFunctionAbstract $reflection)
    {
        $this->reflection = $reflection;
        $this->requirements = array();
    }
    
    /**
     * @inheritdoc
     */
    public function collectRequirements()
    {
        foreach ($this->reflection->getParameters() as $parameter) {
            $requirement = $this->createRequirement($parameter);
            $resourceName = $requirement->getResourceName();

            $this->requirements[$resourceName] = $requirement;
        }
    }

    /**
     * @inheritdoc
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->requirements);
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

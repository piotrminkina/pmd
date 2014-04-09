<?php

namespace PMD\ResourcesResolverBundle\RequirementsCollector;

use PMD\ResourcesResolverBundle\Requirement\ParameterRequirement;
use PMD\ResourcesResolverBundle\Requirement\RequirementReaderInterface;

/**
 * Class MethodRequirementsCollector
 * @package PMD\ResourcesResolverBundle\RequirementsCollector
 */
class MethodRequirementsCollector implements RequirementsCollectorInterface
{
    /**
     * @var \ReflectionMethod
     */
    protected $method;

    /**
     * @var RequirementReaderInterface[]
     */
    protected $requirements;

    /**
     * @param \ReflectionMethod $method
     */
    public function __construct(\ReflectionMethod $method)
    {
        $this->method = $method;
        $this->requirements = array();
    }

    /**
     * @inheritdoc
     */
    public function collectRequirements()
    {
        foreach ($this->method->getParameters() as $parameter) {
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
     * @return RequirementReaderInterface
     */
    protected function createRequirement(\ReflectionParameter $parameter)
    {
        return new ParameterRequirement($parameter);
    }
}

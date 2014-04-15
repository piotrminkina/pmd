<?php

namespace PMD\ResourcesResolverBundle\RequirementsCollector;

use PMD\ResourcesResolverBundle\Requirement\ParameterRequirement;
use PMD\ResourcesResolverBundle\Requirement\RequirementReaderInterface;

/**
 * Class FunctionRequirementsCollector
 * @package PMD\ResourcesResolverBundle\RequirementsCollector
 */
class FunctionRequirementsCollector implements RequirementsCollectorInterface
{
    /**
     * @var \ReflectionFunction
     */
    protected $function;

    /**
     * @var RequirementReaderInterface[]
     */
    protected $requirements;

    /**
     * @param \ReflectionFunction $function
     */
    public function __construct(\ReflectionFunction $function)
    {
        $this->function = $function;
        $this->requirements = array();
    }

    /**
     * @inheritdoc
     */
    public function collectRequirements()
    {
        foreach ($this->function->getParameters() as $parameter) {
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

<?php

namespace PMD\ResourcesResolverBundle\Requirement;

/**
 * Class ParameterRequirement
 * @package PMD\ResourcesResolverBundle\Requirement
 */
class ParameterRequirement implements RequirementReaderInterface
{
    /**
     * @var \ReflectionParameter
     */
    protected $parameter;

    /**
     * @param \ReflectionParameter $parameter
     */
    public function __construct(\ReflectionParameter $parameter)
    {
        $this->parameter = $parameter;
    }

    /**
     * @inheritdoc
     */
    public function isOptional()
    {
        return $this->parameter->isOptional();
    }

    /**
     * @inheritdoc
     */
    public function getClass()
    {
        $class = $this->parameter->getClass();

        if ($class) {
            return $class->getName();
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->parameter->getName();
    }
}

<?php

namespace PMD\ResourcesResolverBundle\Requirement;

use Doctrine\Common\Inflector\Inflector;

/**
 * Class CallbackParameter
 * @package PMD\ResourcesResolverBundle\Requirement
 */
class CallbackParameter implements RequirementInterface
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
    public function getResourceName()
    {
        return Inflector::tableize($this->parameter->getName());
    }

    /**
     * @inheritdoc
     */
    public function getResolvedName()
    {
        return $this->parameter->getName();
    }
}

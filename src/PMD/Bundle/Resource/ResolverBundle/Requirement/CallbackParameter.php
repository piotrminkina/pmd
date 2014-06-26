<?php

/*
 * This file is part of the PMDResourcesResolverBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\ResourcesResolverBundle\Requirement;

use Doctrine\Common\Inflector\Inflector;

/**
 * Class CallbackParameter
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
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

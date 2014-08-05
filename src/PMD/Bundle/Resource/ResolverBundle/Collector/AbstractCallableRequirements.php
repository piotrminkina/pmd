<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\Resource\ResolverBundle\Collector;

use PMD\Bundle\Resource\ResolverBundle\Requirement\CallbackParameter;
use PMD\Bundle\Resource\ResolverBundle\Requirement\RequirementInterface;

/**
 * Class AbstractCallableRequirements
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Collector
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

<?php

namespace PMD\ResourcesResolverBundle\Factory;

use Symfony\Component\HttpFoundation\Request;
use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\RequirementsCollector\MethodRequirementsCollector;
use PMD\ResourcesResolverBundle\ResourcesInjector\RequestAttributeInjector;

/**
 * Class Factory
 * @package PMD\ResourcesResolverBundle\RequirementsCollector
 */
class Factory implements FactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createRequirementsCollector($callback)
    {
        if (is_array($callback)) {
            if (count($callback) == 2) {
                $method = new \ReflectionMethod($callback[0], $callback[1]);

                $collector = new MethodRequirementsCollector($method);
                $collector->collectRequirements();

                return $collector;
            }
        }

        throw new InvalidArgumentException('Unsupported callback type');
    }

    /**
     * @inheritdoc
     */
    public function createResourcesInjector(Request $request)
    {
        return new RequestAttributeInjector($request);
    }
}

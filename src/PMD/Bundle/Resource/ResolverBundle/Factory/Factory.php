<?php

namespace PMD\ResourcesResolverBundle\Factory;

use
    PMD\ResourcesResolverBundle\RequirementsCollector\FunctionRequirementsCollector;
use Symfony\Component\HttpFoundation\Request;
use PMD\ResourcesResolverBundle\Exception\InvalidArgumentException;
use PMD\ResourcesResolverBundle\RequirementsCollector\MethodRequirementsCollector;
use PMD\ResourcesResolverBundle\Injector\RequestAttributeInjector;

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
        } elseif (is_scalar($callback)) {
            $function = new \ReflectionFunction($callback);

            $collector = new FunctionRequirementsCollector($function);
            $collector->collectRequirements();

            return $collector;
        }

        throw new InvalidArgumentException('Unsupported callback type');
    }

    /**
     * @inheritdoc
     */
    public function createInjector(Request $request)
    {
        return new RequestAttributeInjector($request);
    }
}

<?php

/*
 * This file is part of the PMDRoutingBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\RoutingBundle\Routing\Generator;

use Symfony\Component\Routing\Generator\UrlGenerator as BaseUrlGenerator;
use Doctrine\Common\Inflector\Inflector;

/**
 * Class UrlGenerator
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\RoutingBundle\Routing\Generator
 */
class UrlGenerator extends BaseUrlGenerator
{
    /**
     * @param $variables
     * @param $defaults
     * @param $requirements
     * @param $tokens
     * @param $parameters
     * @param $name
     * @param $referenceType
     * @param $hostTokens
     * @param array $requiredSchemes
     * @return null|string
     */
    protected function doGenerate(
        $variables,
        $defaults,
        $requirements,
        $tokens,
        $parameters,
        $name,
        $referenceType,
        $hostTokens,
        array $requiredSchemes = []
    ) {
        if (is_object($parameters)) {
            $object = $parameters;
            $parameters = [];
        } elseif (isset($parameters['object']) && is_object($parameters['object'])) {
            $object = $parameters['object'];
            unset($parameters['object']);
        }

        if (isset($object)) {
            $mergedParams = array_replace($defaults, $this->context->getParameters(), $parameters);
            $requiredParams = array_diff_key(array_flip($variables), $mergedParams);

            $parameters += $this->getParametersFromObject(array_keys($requiredParams), $object);
        }

        return BaseUrlGenerator::doGenerate(
            $variables,
            $defaults,
            $requirements,
            $tokens,
            $parameters,
            $name,
            $referenceType,
            $hostTokens,
            $requiredSchemes
        );
    }

    /**
     * @param $keys
     * @param $object
     * @return array
     */
    protected function getParametersFromObject($keys, $object)
    {
        $parameters = [];

        foreach ($keys as $key) {
            $relation = $object;

            $method = 'get' . Inflector::classify($key);

            if (method_exists($relation, $method)) {
                $relation = $relation->$method();
            } else {
                $segments = explode('_', $key);

                if (count($segments) > 1) {
                    foreach ($segments as $segment) {
                        $method = 'get' . Inflector::classify($segment);

                        if (method_exists($relation, $method)) {
                            $relation = $relation->$method();
                        } else {
                            $relation = $object;
                            break;
                        }
                    }
                }
            }

            if ($object !== $relation) {
                $parameters[$key] = $relation;
            }
        }

        return $parameters;
    }
}

<?php

/*
 * This file is part of the PMDResourcesResolverBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\ResourcesResolverBundle\Collector;

/**
 * Class MethodRequirements
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\ResourcesResolverBundle\Collector
 */
class MethodRequirements extends AbstractCallableRequirements
{
    /**
     * @param mixed $class
     * @param string $name
     */
    public function __construct($class, $name)
    {
        parent::__construct(new \ReflectionMethod($class, $name));
    }
}

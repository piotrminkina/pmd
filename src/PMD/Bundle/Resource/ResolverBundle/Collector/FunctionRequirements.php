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
 * Class FunctionRequirements
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\ResourcesResolverBundle\Collector
 */
class FunctionRequirements extends AbstractCallableRequirements
{
    /**
     * @param mixed $name
     */
    public function __construct($name)
    {
        parent::__construct(new \ReflectionFunction($name));
    }
}

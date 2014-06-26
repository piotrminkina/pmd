<?php

/*
 * This file is part of the PMDResourcesResolverBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\ResourcesResolverBundle\Collector\Decorator;

use Symfony\Component\HttpFoundation\Request;
use PMD\ResourcesResolverBundle\Collector\CollectorInterface;

/**
 * Class AbstractRequestDecorator
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\ResourcesResolverBundle\Collector\Decorator
 */
abstract class AbstractRequestDecorator extends AbstractDecorator
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @param CollectorInterface $collector
     * @param Request $request
     */
    public function __construct(CollectorInterface $collector, Request $request)
    {
        parent::__construct($collector);

        $this->request = $request;
    }
}

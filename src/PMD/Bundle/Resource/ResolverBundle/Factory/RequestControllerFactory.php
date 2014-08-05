<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\Resource\ResolverBundle\Factory;

use PMD\Bundle\Resource\ResolverBundle\Parser\ExpressionParser;
use PMD\Bundle\Resource\ResolverBundle\Parser\ParserChain;
use PMD\Bundle\Resource\ResolverBundle\Parser\ServiceParser;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use PMD\Bundle\Resource\ResolverBundle\Collector\Decorator\FilterExistsRequestAttribute;
use PMD\Bundle\Resource\ResolverBundle\Collector\Decorator\FilterRequestClass;
use PMD\Bundle\Resource\ResolverBundle\Collector\FunctionRequirements;
use PMD\Bundle\Resource\ResolverBundle\Collector\MethodRequirements;
use PMD\Bundle\Resource\ResolverBundle\Exception\InvalidArgumentException;
use PMD\Bundle\Resource\ResolverBundle\Injector\RequestAttributeInjector;
use PMD\Bundle\Resource\ResolverBundle\Parser\ParserInterface;
use PMD\Bundle\Resource\ResolverBundle\Parser\RecursiveParser;
use PMD\Bundle\Resource\ResolverBundle\Provider\Decorator\ParseDecorator;
use PMD\Bundle\Resource\ResolverBundle\Provider\RequestProvider;
use PMD\Bundle\Resource\ResolverBundle\Resolver\Resolver;

/**
 * Class RequestControllerFactory
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Factory
 */
class RequestControllerFactory implements FactoryInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var Request|null
     */
    protected $request;

    /**
     * @var callable|null
     */
    protected $controller;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param Request $request
     * @return RequestControllerFactory
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return Request|null
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param callable $controller
     * @return RequestControllerFactory
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * @return callable|null
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @inheritdoc
     */
    public function createCollector()
    {
        $request = $this->request;
        $controller = $this->controller;
        $collector = null;

        if (is_array($controller) && count($controller) == 2) {
            $collector = new MethodRequirements($controller[0], $controller[1]);
        } elseif (is_string($controller)) {
            $collector = new FunctionRequirements($controller);
        }

        if (!$collector) {
            throw new InvalidArgumentException('Unsupported controller type');
        }
        $collector = new FilterExistsRequestAttribute($collector, $request);
        $collector = new FilterRequestClass($collector, $request);

        return $collector;
    }

    /**
     * @inheritdoc
     */
    public function createInjector()
    {
        $request = $this->request;

        if (!$request instanceof Request) {
            throw new InvalidArgumentException('Unsupported request type');
        }

        return new RequestAttributeInjector($this->request);
    }

    /**
     * @return ParserInterface
     */
    public function createParser()
    {
        $parser = new ParserChain(
            array(
                new ExpressionParser($this->container, $this->request),
                new ServiceParser($this->container),
            )
        );
        $parser = new RecursiveParser($parser);

        return $parser;
    }

    /**
     * @inheritdoc
     */
    public function createProvider()
    {
        $parser = $this->createParser();

        $provider = new RequestProvider($this->request);
        $provider = new ParseDecorator($provider, $parser);

        return $provider;
    }

    /**
     * @inheritdoc
     */
    public function createResolver()
    {
        $provider = $this->createProvider();

        return new Resolver($provider);
    }
}

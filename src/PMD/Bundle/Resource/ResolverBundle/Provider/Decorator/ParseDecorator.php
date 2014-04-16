<?php

namespace PMD\ResourcesResolverBundle\Provider\Decorator;

use PMD\ResourcesResolverBundle\Parser\ParserInterface;
use PMD\ResourcesResolverBundle\Provider\ProviderInterface;

/**
 * Class ParseDecorator
 * @package PMD\ResourcesResolverBundle\Provider\Decorator
 */
class ParseDecorator extends AbstractDecorator
{
    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * @param ProviderInterface $provider
     * @param ParserInterface $parser
     */
    public function __construct(
        ProviderInterface $provider,
        ParserInterface $parser
    ) {
        parent::__construct($provider);

        $this->parser = $parser;
    }

    /**
     * @inheritdoc
     */
    public function get($name)
    {
        $resource = $this->provider->get($name);
        $resource = $this->parser->parse($resource);

        return $resource;
    }
}

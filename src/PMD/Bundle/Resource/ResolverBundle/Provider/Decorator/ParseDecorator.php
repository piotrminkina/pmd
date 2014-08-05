<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\Resource\ResolverBundle\Provider\Decorator;

use PMD\Bundle\Resource\ResolverBundle\Parser\ParserInterface;
use PMD\Bundle\Resource\ResolverBundle\Provider\ProviderInterface;

/**
 * Class ParseDecorator
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Provider\Decorator
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

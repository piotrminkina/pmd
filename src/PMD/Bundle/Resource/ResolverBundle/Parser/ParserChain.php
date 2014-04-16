<?php

namespace PMD\ResourcesResolverBundle\Parser;

/**
 * Class ParserChain
 * @package PMD\ResourcesResolverBundle\Parser
 */
class ParserChain implements ParserInterface
{
    /**
     * @var ParserInterface[]
     */
    protected $parsers;

    /**
     * @param ParserInterface[] $parsers
     */
    public function __construct(array $parsers)
    {
        $this->parsers = $parsers;
    }

    /**
     * @inheritdoc
     */
    public function parse($definition)
    {
        foreach ($this->parsers as $parser) {
            $definition = $parser->parse($definition);
        }

        return $definition;
    }
}

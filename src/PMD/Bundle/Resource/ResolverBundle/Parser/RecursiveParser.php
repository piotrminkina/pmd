<?php

namespace PMD\ResourcesResolverBundle\Parser;

/**
 * Class RecursiveFakeParser
 * @package PMD\ResourcesResolverBundle\Provider\Parser
 */
class RecursiveParser implements ParserInterface
{
    /**
     * @var ParserInterface
     */
    protected $parser;

    /**
     * @param ParserInterface $parser
     */
    public function __construct(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @inheritdoc
     */
    public function parse($definition)
    {
        if (is_array($definition)) {
            return array_map(array($this, 'parse'), $definition);
        }

        return $this->parser->parse($definition);
    }
}

<?php

/*
 * This file is part of the PMDResourcesResolverBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\ResourcesResolverBundle\Parser;

/**
 * Class RecursiveParser
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\ResourcesResolverBundle\Parser
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

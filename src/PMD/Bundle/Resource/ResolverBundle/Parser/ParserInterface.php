<?php

namespace PMD\ResourcesResolverBundle\Parser;

/**
 * Class ParserInterface
 * @package PMD\ResourcesResolverBundle\Provider\Parser
 */
interface ParserInterface
{
    /**
     * @param mixed $definition
     * @return mixed
     */
    public function parse($definition);
}

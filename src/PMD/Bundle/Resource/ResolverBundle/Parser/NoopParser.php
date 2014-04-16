<?php

namespace PMD\ResourcesResolverBundle\Parser;

/**
 * Class NoopParser
 * @package PMD\ResourcesResolverBundle\Parser
 */
class NoopParser implements ParserInterface
{
    /**
     * @inheritdoc
     */
    public function parse($definition)
    {
        return $definition;
    }
}

<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\Resource\ResolverBundle\Parser;

/**
 * Class NoopParser
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\Resource\ResolverBundle\Parser
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

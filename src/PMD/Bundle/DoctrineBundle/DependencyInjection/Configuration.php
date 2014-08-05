<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\DoctrineBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\DoctrineBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    protected $alias;

    /**
     * @param $alias
     */
    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = $this->createTreeBuilder();
        $rootNode = $treeBuilder->root($this->alias);

        $rootNode
            ->children()
                ->append($this->addOrmNode())
            ->end();

        return $treeBuilder;
    }

    /**
     * @return NodeDefinition
     */
    protected function addOrmNode()
    {
        $treeBuilder = $this->createTreeBuilder();
        $node = $treeBuilder->root('orm');

        $node
            ->children()
            ->end();

        return $node;
    }

    /**
     * @return TreeBuilder
     */
    protected function createTreeBuilder()
    {
        return new TreeBuilder();
    }
}

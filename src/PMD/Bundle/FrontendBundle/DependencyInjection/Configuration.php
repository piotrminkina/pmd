<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\FrontendBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\FrontendBundle\DependencyInjection
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
                ->append($this->addListenersNode())
            ->end();

        return $treeBuilder;
    }

    /**
     * @return NodeDefinition
     */
    protected function addListenersNode()
    {
        $treeBuilder = $this->createTreeBuilder();
        $node = $treeBuilder->root('listeners');

        $node
            ->fixXmlConfig('listener')
            ->append($this->addViewListenerNode());

        return $node;
    }

    /**
     * @return NodeDefinition
     */
    protected function addViewListenerNode()
    {
        $treeBuilder = $this->createTreeBuilder();
        $node = $treeBuilder->root('view_listener');

        $node
            ->fixXmlConfig('option')
            ->children()
                ->integerNode('controller_priority')
                    ->defaultValue(-256)
                    ->cannotBeEmpty()
                ->end()
                ->integerNode('view_priority')
                    ->defaultValue(64)
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('view_attribute')
                    ->defaultValue('_view')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('vars_attribute')
                    ->defaultValue('_vars')
                    ->cannotBeEmpty()
                ->end()
                ->booleanNode('auto_guess')
                    ->defaultValue(true)
                    ->treatNullLike(true)
                ->end()
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

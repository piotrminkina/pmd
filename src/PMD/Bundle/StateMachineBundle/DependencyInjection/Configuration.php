<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\DependencyInjection
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
                ->append($this->addDefinitionsNode())
            ->end();

        return $treeBuilder;
    }

    /**
     * @return NodeDefinition
     */
    protected function addDefinitionsNode()
    {
        $treeBuilder = $this->createTreeBuilder();
        $node = $treeBuilder->root('definitions');

        $node
            ->fixXmlConfig('definition')
            ->useAttributeAsKey('id')
            ->prototype('array')
                ->cannotBeOverwritten()
                ->children()
                    ->scalarNode('name')
                        ->isRequired()
                    ->end()
                    ->scalarNode('description')
                    ->end()
                    ->append($this->addStatesNode())
                ->end()
            ->end();

        return $node;
    }

    /**
     * @return NodeDefinition
     */
    protected function addStatesNode()
    {
        $treeBuilder = $this->createTreeBuilder();
        $node = $treeBuilder->root('states');

        $node
            ->fixXmlConfig('state')
            ->useAttributeAsKey('name')
            ->prototype('array')
                ->cannotBeOverwritten()
                ->children()
                    ->append($this->addTransitionsNode())
                ->end()
            ->end();

        return $node;
    }

    /**
     * @return NodeDefinition
     */
    protected function addTransitionsNode()
    {
        $treeBuilder = $this->createTreeBuilder();
        $node = $treeBuilder->root('transitions');

        $node
            ->fixXmlConfig('transition')
            ->useAttributeAsKey('target')
            ->prototype('scalar')
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

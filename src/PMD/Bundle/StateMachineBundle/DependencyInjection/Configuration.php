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
            ->performNoDeepMerging()
            ->useAttributeAsKey('name')
            ->prototype('array')
                ->cannotBeOverwritten()
                ->beforeNormalization()
                    ->always(
                        function (array $definition) {
                            return $this->normalizeDefinition($definition);
                        }
                    )
                ->end()
                ->children()
                    ->append($this->addStatesNode())
                    ->append($this->addTransitionsNode())
                ->end()
            ->end();

        return $node;
    }

    /**
     * @param array $definition
     * @return array
     */
    protected function normalizeDefinition(array $definition)
    {
        if (!isset($definition['transitions'])) {
            $definition['transitions'] = array();
        }

        $states = array();
        $transitions = $definition['transitions'];

        foreach ($definition['states'] as $stateName => $stateValues) {
            if (is_array($stateValues)) {
                $states[] = $stateName;
            } else {
                $states[] = $stateValues;
                continue;
            }

            if (!isset($stateValues['transitions'])) {
                continue;
            }

            foreach ($stateValues['transitions'] as $transitionName => $targetStateName) {
                $transitionName = $stateName . '_' . $transitionName;
                $transitions[$transitionName] = array(
                    'from' => $stateName,
                    'to' => $targetStateName,
                );
            }
        }

        $definition['states'] = $states;
        $definition['transitions'] = $transitions;

        return $definition;
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
            ->isRequired()
            ->requiresAtLeastOneElement()
            ->prototype('scalar')
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
            ->isRequired()
            ->requiresAtLeastOneElement()
            ->useAttributeAsKey('name')
            ->prototype('array')
                ->children()
                    ->scalarNode('from')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                    ->scalarNode('to')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
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

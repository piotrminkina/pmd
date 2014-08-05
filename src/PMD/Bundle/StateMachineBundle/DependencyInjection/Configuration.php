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
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = $this->createTreeBuilder();
        $rootNode = $treeBuilder->root('pmd_state_machine');

        $rootNode
            ->children()
                ->append($this->addRequestNode())
                ->append($this->addDefinitionsNode())
            ->end();

        return $treeBuilder;
    }

    /**
     * @return NodeDefinition
     */
    protected function addRequestNode()
    {
        $treeBuilder = $this->createTreeBuilder();
        $node = $treeBuilder->root('request');

        $node
            ->fixXmlConfig('attribute')
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('attribute')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('process_path')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('_state_process')
                        ->end()
                        ->scalarNode('action_path')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('_state_action')
                        ->end()
                        ->scalarNode('response_path')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->defaultValue('_state_response')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $node;
    }

    /**
     * @return NodeDefinition
     */
    protected function addDefinitionsNode()
    {
        $context = $this;
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
                        function (array $definition) use ($context) {
                            return $context->normalizeDefinition($definition);
                        }
                    )
                ->end()
                ->children()
                    ->append($this->addStatesNode())
                    ->append($this->addTransitionsNode())
                    ->append($this->addBehaviorsNode())
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
        $states = array();
        $transitions = array();
        $behaviors = array();

        foreach ($definition as $stateName => $stateValues) {
            $states[] = $stateName;

            if (!is_array($stateValues)) {
                continue;
            }

            foreach ($stateValues as $transitionLabel => $transitionValues) {
                $transitionName = $stateName . '_' . $transitionLabel;
                $fromStateName = $stateName;
                $toStateName = $transitionValues;
                $requestMethod = null;

                if (is_array($transitionValues)) {
                    $toStateName = $transitionValues['to'];
                    $requestMethod = isset($transitionValues['method'])
                        ? $transitionValues['method']
                        : null;
                    unset($transitionValues['to'], $transitionValues['method']);

                    foreach ($transitionValues as $behaviorsGroup => $behaviorGroupValues) {
                        if (!isset($behaviors[$behaviorsGroup])) {
                            $behaviors[$behaviorsGroup] = array();
                        }

                        foreach ($behaviorGroupValues as $behaviorType => $behaviorTypeValues) {
                            $behaviorName = $transitionName . '_' . $behaviorType;

                            $behaviors[$behaviorsGroup][$behaviorName] = array(
                                'type' => $behaviorType,
                                'state' => $stateName,
                                'transition' => $transitionLabel,
                                'options' => $behaviorTypeValues
                            );
                        }
                    }
                }

                $transitions[$transitionName] = array(
                    'label' => $transitionLabel,
                    'method' => $requestMethod,
                    'from' => $fromStateName,
                    'to' => $toStateName,
                );
            }
        }

        return array(
            'states' => $states,
            'transitions' => $transitions,
            'behaviors' => $behaviors,
        );
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
                    ->scalarNode('label')
                        ->isRequired()
                        ->cannotBeEmpty()
                    ->end()
                    ->scalarNode('method')
                        ->isRequired()
                        ->cannotBeEmpty()
                        ->treatNullLike('post')
                    ->end()
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
     * @return NodeDefinition
     */
    protected function addBehaviorsNode()
    {
        $treeBuilder = $this->createTreeBuilder();
        $node = $treeBuilder->root('behaviors');

        $node
            ->fixXmlConfig('behavior')
            ->useAttributeAsKey('group')
            ->prototype('array')
                ->useAttributeAsKey('name')
                ->prototype('array')
                    ->children()
                        ->scalarNode('type')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('state')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('transition')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->variableNode('options')
                            ->treatNullLike(array())
                        ->end()
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

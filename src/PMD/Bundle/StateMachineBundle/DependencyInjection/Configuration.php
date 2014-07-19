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
                    ->append($this->addGuardsNode())
                    ->append($this->addActionsNode())
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
        $guards = array();
        $actions = array();

        foreach ($definition as $stateName => $stateValues) {
            $states[] = $stateName;

            if (!is_array($stateValues)) {
                continue;
            }

            foreach ($stateValues as $transitionLabel => $transitionValues) {
                $transitionName = $stateName . '_' . $transitionLabel;
                $fromStateName = $stateName;
                $toStateName = $transitionValues;

                if (is_array($transitionValues)) {
                    $toStateName = $transitionValues['to'];

                    if (isset($transitionValues['guards'])) {
                        foreach ($transitionValues['guards'] as $guardType => $guardValues) {
                            $guardName = $transitionName . '_' . $guardType;

                            $guards[$guardName] = array(
                                'type' => $guardType,
                                'transition' => $transitionName,
                                'options' => $guardValues,
                            );
                        }
                    }

                    if (isset($transitionValues['actions'])) {
                        foreach ($transitionValues['actions'] as $actionType => $actionValues) {
                            $actionName = $transitionName . '_' . $actionType;

                            $actions[$actionName] = array(
                                'type' => $actionType,
                                'transition' => $transitionName,
                                'options' => $actionValues,
                            );
                        }

                    }
                }

                $transitions[$transitionName] = array(
                    'label' => $transitionLabel,
                    'from' => $fromStateName,
                    'to' => $toStateName,
                );
            }
        }

        return array(
            'states' => $states,
            'transitions' => $transitions,
            'guards' => $guards,
            'actions' => $actions,
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
    protected function addGuardsNode()
    {
        $treeBuilder = $this->createTreeBuilder();
        $node = $treeBuilder->root('guards');

        $node
            ->fixXmlConfig('guard')
            ->useAttributeAsKey('name')
            ->prototype('array')
                ->children()
                    ->scalarNode('type')
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
            ->end();

        return $node;
    }

    /**
     * @return NodeDefinition
     */
    protected function addActionsNode()
    {
        $treeBuilder = $this->createTreeBuilder();
        $node = $treeBuilder->root('actions');

        $node
            ->fixXmlConfig('action')
            ->useAttributeAsKey('name')
            ->prototype('array')
                ->children()
                    ->scalarNode('type')
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

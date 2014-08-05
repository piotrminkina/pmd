<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ConfigProcessor
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\DependencyInjection
 */
class ConfigProcessor
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    /**
     * @param array $config
     * @param ContainerBuilder $container
     */
    public function process(array $config, ContainerBuilder $container)
    {
        $this->container = $container;

        $this->processRequest($config['request']);
        $this->processDefinitions($config['definitions']);
    }

    /**
     * @param array $request
     */
    protected function processRequest(array $request)
    {
        $definition = $this->container->getDefinition(
            'pmd_state_machine.handler.state_handler'
        );
        $attribute = $request['attribute'];

        $definition
            ->addMethodCall('setProcessPath', array($attribute['process_path']))
            ->addMethodCall('setActionPath', array($attribute['action_path']))
            ->addMethodCall('setResponsePath', array($attribute['response_path']));

        $definition = $this->container->getDefinition(
            'pmd_state_machine.provider.tokens_provider'
        );
        $definition
            ->addMethodCall('setProcessPath', array($attribute['process_path']));
    }

    /**
     * @param array $definitions
     * @return array
     */
    protected function processDefinitions(array $definitions)
    {
        $services = array();

        foreach ($definitions as $name => $definition) {
            $builderName = sprintf('pmd_state_machine.%s_process_builder', $name);
            $processName = sprintf('pmd_state_machine.%s_process', $name);
            $coordinatorName = sprintf('pmd_state_machine.%s_coordinator', $name);

            $builder = $this->getBuilderDefinition($name);
            $process = $this->getProcessDefinition($builderName, $name);
            $coordinator = $this->getCoordinatorDefinition($processName, $name);

            $this->processStates($builder, $definition['states']);
            $this->processTransitions($builder, $definition['transitions']);
            $this->processBehaviors($name, $definition['behaviors']);

            $services[$builderName] = $builder;
            $services[$processName] = $process;
            $services[$coordinatorName] = $coordinator;
        }

        $this->container->addDefinitions($services);
    }

    /**
     * @param Definition $serviceDefinition
     * @param array $states
     */
    protected function processStates(
        Definition $serviceDefinition,
        array $states
    ) {
        foreach ($states as $state) {
            $serviceDefinition->addMethodCall('addState', array($state));
        }
    }

    /**
     * @param Definition $serviceDefinition
     * @param array $transitions
     */
    protected function processTransitions(
        Definition $serviceDefinition,
        array $transitions
    ) {
        foreach ($transitions as $transitionName => $transition) {
            $serviceDefinition->addMethodCall(
                'addTransition',
                array($transitionName, $transition['label'], $transition['method'])
            );

            $serviceDefinition->addMethodCall(
                'linkStates',
                array(
                    $transition['from'],
                    $transitionName,
                    $transition['to'],
                )
            );
        }
    }

    /**
     * @param string $definitionName
     * @param array $groupedBehaviors
     */
    protected function processBehaviors($definitionName, array $groupedBehaviors)
    {
        foreach ($groupedBehaviors as $groupName => $behaviors) {
            foreach ($behaviors as $behavior) {
                $stateName = $behavior['state'];
                $transitionName = $behavior['transition'];

                $accessKey = array($definitionName, $stateName, $transitionName);
                $accessKey = join('.', $accessKey);

                $typeName = $behavior['type'];
                $options = $behavior['options'];

                if (!isset($options['enabled'])) {
                    $options['enabled'] = true;
                }

                $serviceId = sprintf(
                    'pmd_state_machine.behavior.%s_%s_options',
                    $groupName,
                    $typeName
                );

                if (!$this->container->hasDefinition($serviceId)) {
                    $this->container->setDefinition(
                        $serviceId,
                        new DefinitionDecorator(
                            'pmd_state_machine.behavior_options.options_registry'
                        )
                    );
                }

                $serviceDefinition = $this->container->getDefinition($serviceId);
                $serviceDefinition->addMethodCall(
                    'add',
                    array($accessKey, $options)
                );
            }
        }
    }

    /**
     * @param string $definitionName
     * @return Definition
     */
    protected function getBuilderDefinition($definitionName)
    {
        $builder = new DefinitionDecorator(
            'pmd_state_machine.process_builder.definition_builder'
        );

        $builder->addMethodCall('setName', array($definitionName));

        return $builder;
    }

    /**
     * @param string $builderName
     * @param string $definitionName
     * @return Definition
     */
    protected function getProcessDefinition($builderName, $definitionName)
    {
        $process = new DefinitionDecorator(
            'pmd_state_machine.process.definition'
        );

        $process
            ->setFactoryService($builderName)
            ->setFactoryMethod('getDefinition')
            ->addTag(
                'pmd_state_machine.definition',
                array('alias' => $definitionName)
            );

        return $process;
    }

    /**
     * @param string $processName
     * @param string $definitionName
     * @return Definition
     */
    protected function getCoordinatorDefinition($processName, $definitionName)
    {
        $coordinator = new DefinitionDecorator(
            'pmd_state_machine.process.coordinator'
        );

        $coordinator
            ->addArgument(new Reference($processName))
            ->addTag(
                'pmd_state_machine.coordinator',
                array('alias' => $definitionName)
            );

        return $coordinator;
    }
}

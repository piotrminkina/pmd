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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Class ConfigProcessor
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\DependencyInjection
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
            ->addMethodCall('setActionPath', array($attribute['action_path']));
    }

    /**
     * @param array $definitions
     * @return array
     */
    protected function processDefinitions(array $definitions)
    {
        $servicesDefinitions = array();

        foreach ($definitions as $name => $definition) {
            $builderName = sprintf('pmd_state_machine.%s_builder', $name);
            $processName = sprintf('pmd_state_machine.%s_definition', $name);

            $builderDefinition = $this->getBuilderDefinition($name);
            $processDefinition = $this->getProcessDefinition($builderName, $name);

            $this->processStates($builderDefinition, $definition['states']);
            $this->processTransitions($builderDefinition, $definition['transitions']);

            $servicesDefinitions[$builderName] = $builderDefinition;
            $servicesDefinitions[$processName] = $processDefinition;
        }

        $this->container->addDefinitions($servicesDefinitions);
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
                array($transitionName, $transition['label'])
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
     * @return Definition
     */
    protected function getBuilderDefinition($definitionName)
    {
        $builderDefinition = clone $this->container->getDefinition(
            'pmd_state_machine.process_builder.definition_builder'
        );

        $builderDefinition->addMethodCall('setName', array($definitionName));

        return $builderDefinition;
    }

    /**
     * @param string $builderName
     * @param string $definitionName
     * @return Definition
     */
    protected function getProcessDefinition($builderName, $definitionName)
    {
        $processDefinition = new Definition(
            'PMD\StateMachineBundle\Process\DefinitionInterface'
        );

        $processDefinition
            ->setFactoryService($builderName)
            ->setFactoryMethod('getDefinition')
            ->addTag(
                'pmd_state_machine.definition',
                array('alias' => $definitionName)
            );

        return $processDefinition;
    }
}

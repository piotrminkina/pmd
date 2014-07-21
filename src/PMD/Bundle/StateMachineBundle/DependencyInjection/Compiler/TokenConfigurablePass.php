<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class TokenConfigurablePass
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\DependencyInjection\Compiler
 */
class TokenConfigurablePass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        $definitions = array();
        $servicesIds = $container->findTaggedServiceIds(
            'pmd_state_machine.token_configurable'
        );

        foreach ($servicesIds as $serviceId => $tag) {
            $group = isset($tag[0]['group'])
                ? $tag[0]['group']
                : null;
            $type = isset($tag[0]['type'])
                ? $tag[0]['type']
                : null;

            if (!isset($group) || !isset($type)) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Services tagged %s must have group and type defined',
                        'pmd_state_machine.token_configurable'
                    )
                );
            }

            $serviceDefinition = $container->getDefinition($serviceId);

            $optionsId = sprintf(
                'pmd_state_machine.behavior.%s_%s_options',
                $group,
                $type
            );
            $optionsReference = new Reference($optionsId);

            // Configure options resolver
            $resolverId = sprintf(
                'pmd_state_machine.behavior.%s_%s_resolver',
                $group,
                $type
            );
            $resolverReference = new Reference($resolverId);
            $resolverDefinition = new DefinitionDecorator(
                'pmd_state_machine.behavior_resolver.token_options_resolver'
            );
            $resolverDefinition->replaceArgument(0, $optionsReference);

            // Configure configurable decorator
            $configId = sprintf(
                'pmd_state_machine.behavior.%s_%s_configurator',
                $group,
                $type
            );
            $configDefinition = new DefinitionDecorator(
                'pmd_state_machine.behavior.token_configurable_configurator'
            );
            $configDefinition->replaceArgument(0, $resolverReference);

            $serviceDefinition->setConfigurator(
                array(
                    new Reference(
                        $configId,
                        ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE,
                        false
                    ),
                    'configure'
                )
            );

            $definitions[$resolverId] = $resolverDefinition;
            $definitions[$configId] = $configDefinition;
        }

        $container->addDefinitions($definitions);
    }
}

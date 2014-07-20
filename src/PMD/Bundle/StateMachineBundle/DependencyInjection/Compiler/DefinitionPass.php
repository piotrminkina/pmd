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

/**
 * Class DefinitionPass
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\DependencyInjection\Compiler
 */
class DefinitionPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        $definitions = array();
        $servicesIds = $container->findTaggedServiceIds(
            'pmd_state_machine.definition'
        );
        $registryDefinition = $container->getDefinition(
            'pmd_state_machine.process_registry.definition_registry'
        );

        foreach ($servicesIds as $serviceId => $tag) {
            $alias = isset($tag[0]['alias'])
                ? $tag[0]['alias']
                : $serviceId;

            $definitions[$alias] = $serviceId;
        }

        $registryDefinition->replaceArgument(0, $definitions);
    }
}

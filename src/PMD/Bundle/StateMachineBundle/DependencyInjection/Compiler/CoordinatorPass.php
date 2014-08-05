<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class CoordinatorPass
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle\DependencyInjection\Compiler
 */
class CoordinatorPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        $coordinators = array();
        $servicesIds = $container->findTaggedServiceIds(
            'pmd_state_machine.coordinator'
        );
        $registryDefinition = $container->getDefinition(
            'pmd_state_machine.process.registry'
        );

        foreach ($servicesIds as $serviceId => $tag) {
            $alias = isset($tag[0]['alias'])
                ? $tag[0]['alias']
                : $serviceId;

            $coordinators[$alias] = $serviceId;
        }

        $registryDefinition->replaceArgument(1, $coordinators);
    }
}

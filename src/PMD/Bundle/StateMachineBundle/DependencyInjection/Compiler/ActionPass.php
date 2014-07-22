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
 * Class ActionPass
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\DependencyInjection\Compiler
 */
class ActionPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        $actions = array();
        $servicesIds = $container->findTaggedServiceIds(
            'pmd_state_machine.action'
        );
        $registryDefinition = $container->getDefinition(
            'pmd_state_machine.action.registry'
        );

        foreach ($servicesIds as $serviceId => $tag) {
            $alias = isset($tag[0]['alias'])
                ? $tag[0]['alias']
                : $serviceId;

            $actions[$alias] = $serviceId;
        }

        $registryDefinition->replaceArgument(0, $actions);
    }
}

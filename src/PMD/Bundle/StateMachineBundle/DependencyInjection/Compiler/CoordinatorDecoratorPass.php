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
 * Class CoordinatorDecoratorPass
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\DependencyInjection\Compiler
 */
class CoordinatorDecoratorPass implements CompilerPassInterface
{
    /**
     * @inheritdoc
     */
    public function process(ContainerBuilder $container)
    {
        $decorators = array();
        $decoratorsIds = $container->findTaggedServiceIds(
            'pmd_state_machine.coordinator_decorator'
        );
        $coordinatorsIds = $container->findTaggedServiceIds(
            'pmd_state_machine.coordinator'
        );

        foreach ($decoratorsIds as $decoratorId => $decoratorTag) {
            $decoratorGroup = isset($decoratorTag[0]['group'])
                ? $decoratorTag[0]['group']
                : $decoratorId;
            $decoratorPriority = isset($decoratorTag[0]['priority'])
                ? $decoratorTag[0]['priority']
                : 0;

            // See below
            $decoratorDefinition = $container->getDefinition($decoratorId);
            $decoratorDefinition->setAbstract(true);

            foreach (array_keys($coordinatorsIds) as $coordinatorId) {
                $concreteId = $coordinatorId.'.'.$decoratorGroup.'_decorator';
                $concreteIdInner = $decoratorId.'.inner';

                // Not works with DefinitionDecorator :(
                $concreteDefinition = clone $decoratorDefinition;
                $concreteDefinition
                    ->setAbstract(false)
                    ->setDecoratedService(
                        $coordinatorId,
                        $concreteIdInner
                    );

                if (!isset($decorators[$decoratorPriority])) {
                    $decorators[$decoratorPriority] = array();
                }
                $decorators[$decoratorPriority][$concreteId] = $concreteDefinition;
            }
        }

        ksort($decorators, SORT_NUMERIC);
        array_map(array($container, 'addDefinitions'), $decorators);
    }
}

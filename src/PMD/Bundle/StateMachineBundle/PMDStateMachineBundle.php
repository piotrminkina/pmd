<?php

/*
 * This file is part of the PMD package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\Bundle\StateMachineBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use PMD\Bundle\StateMachineBundle\DependencyInjection\Compiler\DefinitionPass;
use PMD\Bundle\StateMachineBundle\DependencyInjection\Compiler\CoordinatorPass;
use PMD\Bundle\StateMachineBundle\DependencyInjection\Compiler\CoordinatorDecoratorPass;
use PMD\Bundle\StateMachineBundle\DependencyInjection\Compiler\TokenConfigurablePass;
use PMD\Bundle\StateMachineBundle\DependencyInjection\Compiler\ActionPass;

/**
 * Class PMDStateMachineBundle
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\Bundle\StateMachineBundle
 */
class PMDStateMachineBundle extends Bundle
{
    /**
     * @inheritdoc
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new DefinitionPass());
        $container->addCompilerPass(new CoordinatorPass());
        $container->addCompilerPass(new CoordinatorDecoratorPass());
        $container->addCompilerPass(new TokenConfigurablePass());
        $container->addCompilerPass(new ActionPass());
    }
}

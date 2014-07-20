<?php

/*
 * This file is part of the PMDStateMachineBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\StateMachineBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use PMD\StateMachineBundle\DependencyInjection\Compiler\DefinitionPass;
use PMD\StateMachineBundle\DependencyInjection\Compiler\CoordinatorPass;

/**
 * Class PMDStateMachineBundle
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle
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
    }
}

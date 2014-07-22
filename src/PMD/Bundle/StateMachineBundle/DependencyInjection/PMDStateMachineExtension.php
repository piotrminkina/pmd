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
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

/**
 * Class PMDStateMachineExtension
 * 
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\StateMachineBundle\DependencyInjection
 */
class PMDStateMachineExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('controller.xml');
        $loader->load('provider.xml');
        $loader->load('handler.xml');
        $loader->load('process.xml');
        $loader->load('decorator.xml');
        $loader->load('security.xml');
        $loader->load('behavior.xml');
        $loader->load('services.xml');
        $loader->load('twig.xml');

        $configuration = $this->createConfiguration();
        $config = $this->processConfiguration($configuration, $config);
        $processor = $this->createConfigProcessor();
        $processor->process($config, $container);
    }

    /**
     * @return Configuration
     */
    protected function createConfiguration()
    {
        return new Configuration();
    }

    /**
     * @return ConfigProcessor
     */
    protected function createConfigProcessor()
    {
        return new ConfigProcessor();
    }
}

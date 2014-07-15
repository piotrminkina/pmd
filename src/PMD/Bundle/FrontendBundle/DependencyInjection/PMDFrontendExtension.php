<?php

/*
 * This file is part of the PMDFrontendBundle package.
 *
 * (c) Piotr Minkina <projekty@piotrminkina.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PMD\FrontendBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class PMDFrontendExtension
 *
 * @author Piotr Minkina <projekty@piotrminkina.pl>
 * @package PMD\FrontendBundle\DependencyInjection
 */
class PMDFrontendExtension extends Extension
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
        $loader->load('event.xml');
        $loader->load('templating.xml');
        $loader->load('twig.xml');

        $configuration = new Configuration($this->getAlias());
        $config = $this->processConfiguration($configuration, $config);

        $this->processConfig($config, $container);
    }

    /**
     * @param array $config
     * @param ContainerBuilder $container
     */
    protected function processConfig(array $config, ContainerBuilder $container)
    {
        $listeners = $config['listeners'];
        $this->processViewListenerConfig($listeners['view_listener'], $container);
    }

    /**
     * @param array $config
     * @param ContainerBuilder $container
     */
    protected function processViewListenerConfig(array $config, ContainerBuilder $container)
    {
        $definition = $container->getDefinition('pmd_frontend.event_listener.view_listener');

        $definition->addTag(
            'kernel.event_listener',
            array(
                'event' => KernelEvents::CONTROLLER,
                'method' => 'onKernelController',
                'priority' => $config['controller_priority'],
            )
        );

        $definition->addTag(
            'kernel.event_listener',
            array(
                'event' => KernelEvents::VIEW,
                'method' => 'onKernelView',
                'priority' => $config['view_priority'],
            )
        );

        $definition->addMethodCall(
            'setViewAttribute',
            array(
                $config['view_attribute']
            )
        );

        $definition->addMethodCall(
            'setVarsAttribute',
            array(
                $config['vars_attribute']
            )
        );
    }
}

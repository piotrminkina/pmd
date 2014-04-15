<?php

namespace PMD\ResourcesResolverBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

/**
 * Class PMDResourcesResolverExtension
 * @package PMD\ResourcesResolverBundle\DependencyInjection
 */
class PMDResourcesResolverExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('factory.xml');
        $loader->load('event.xml');
    }

    /**
     * @inheritdoc
     */
    public function getAlias()
    {
        return 'pmd_resources_resolver';
    }
}

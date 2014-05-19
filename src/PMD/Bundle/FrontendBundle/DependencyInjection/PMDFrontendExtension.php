<?php

namespace PMD\FrontendBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

/**
 * Class PMDFrontendExtension
 * @package PMD\PMDFrontendBundle\DependencyInjection
 */
class PMDFrontendExtension extends Extension
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
        //$loader->load('services.xml');
    }

    /**
     * @inheritdoc
     */
    public function getAlias()
    {
        return 'pmd_frontend';
    }
}

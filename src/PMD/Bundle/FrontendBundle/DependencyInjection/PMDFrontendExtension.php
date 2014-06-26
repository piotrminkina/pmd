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
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('event.xml');
        $loader->load('templating.xml');
        $loader->load('twig.xml');
    }

    /**
     * @inheritdoc
     */
    public function getAlias()
    {
        return 'pmd_frontend';
    }
}

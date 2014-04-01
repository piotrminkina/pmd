<?php

namespace PMD\ResourcesResolverBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class PMDResourcesResolverExtension
 * @package PMD\ResourcesResolverBundle\DependencyInjection
 */
class PMDResourcesResolverExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
    }

    public function getAlias()
    {
        return 'pmd_resources_resolver';
    }
}

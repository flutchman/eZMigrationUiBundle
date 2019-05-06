<?php

/**
 * @copyright Copyright (C) Flutchman. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Flutchman\EzMigrationUiBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class FlutchmanEzMigrationUiExtension.
 */
class FlutchmanEzMigrationUiExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }
}

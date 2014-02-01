<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadcka <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\ReporterBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class TadckaReporterExtension
 *
 * @package Tadcka\ReporterBundle\DependencyInjection
 */
class TadckaReporterExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
        $loader->load('form/reporter.xml');
        $loader->load('form/tracker.xml');

        if (!in_array(strtolower($config['db_driver']), array('mongodb', 'orm'))) {
            throw new \InvalidArgumentException(sprintf('Invalid db driver "%s".', $config['db_driver']));
        }
        $loader->load('db_driver/' . sprintf('%s.xml', $config['db_driver']));

        $container->setParameter('tadcka_reporter.model.report_class', $config['class']['model']['report']);
        $container->setParameter('tadcka_reporter.model.status_class', $config['class']['model']['status']);
        $container->setParameter(
            'tadcka_reporter.model.status_translation_class',
            $config['class']['model']['status_translation']
        );
        $container->setParameter('tadcka_reporter.model.tracker_class', $config['class']['model']['tracker']);
        $container->setParameter(
            'tadcka_reporter.model.tracker_translation_class',
            $config['class']['model']['tracker_translation']
        );
    }
}

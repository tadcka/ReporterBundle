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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package Tadcka\ReporterBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tadcka_reporter');

        $rootNode
            ->children()
                ->scalarNode('db_driver')->cannotBeOverwritten()->isRequired()->end()
                ->scalarNode('report_manager')->defaultValue('tadcka_reporter.manager.report.default')->cannotBeEmpty()->end()
                ->scalarNode('status_manager')->defaultValue('tadcka_reporter.manager.status.default')->cannotBeEmpty()->end()
                ->scalarNode('tracker_manager')->defaultValue('tadcka_reporter.manager.tracker.default')->cannotBeEmpty()->end()
                ->arrayNode('class')->isRequired()
                    ->children()
                        ->arrayNode('model')->isRequired()
                            ->children()
                                ->scalarNode('report')->isRequired()->end()
                                ->scalarNode('status')->isRequired()->end()
                                ->scalarNode('status_translation')->isRequired()->end()
                                ->scalarNode('tracker')->isRequired()->end()
                                ->scalarNode('tracker_translation')->isRequired()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}

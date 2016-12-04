<?php

namespace Blog\CoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Blog\CoreBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('core');

        $rootNode->children()
            ->arrayNode('bullshit_filter')
            ->children()
                ->scalarNode('start')->defaultValue('*')->end()
                ->scalarNode('end')->defaultValue('*')->end()
            ->end();

        return $treeBuilder;
    }
}
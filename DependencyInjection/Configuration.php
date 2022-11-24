<?php

namespace RealestateCoNz\ApiClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 *
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('realestateconz_apiclient');
        $rootNode = $treeBuilder->root();

        $rootNode
            ->useAttributeAsKey('name')
            ->prototype('array')
            ->children()
            ->scalarNode('name')->defaultValue('default')->end()
            ->scalarNode('class')->defaultNull()->end()
            ->scalarNode('host')->defaultValue('api.realestate.co.nz')->end()
            ->scalarNode('version')->defaultValue('1')->end()
            ->scalarNode('public_key')->isRequired()->end()
            ->scalarNode('private_key')->isRequired()->end()
            ->end()
            ->end()->end();

        return $treeBuilder;
    }
}

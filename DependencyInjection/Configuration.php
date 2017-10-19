<?php

namespace FLEdev\NoCaptcha\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates Tree Builder
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('no_captcha');
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('wrapper_class')->defaultValue(null)->end()
                ->scalarNode('field_class')->defaultValue(null)->end()
                ->scalarNode('key')->defaultValue(null)->end()
                ->scalarNode('secret')->defaultValue(null)->end()
                ->scalarNode('validation_mesage')->defaultValue(null)->end()
            ->end();

        return $treeBuilder;
    }
}

<?php

namespace Cache\Factory\Config\Adapter;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Memcached extends AbstractConfig
{
    const INDEX_HOST = 'host';

    const INDEX_PORT = 'port';

    /**
     * Returns the adapter specific config builder
     *
     * @return ArrayNodeDefinition|NodeDefinition
     */
    public function getAdapterConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $node        = $treeBuilder->root($this->getAdapterName());

        $node
            ->children()
                ->scalarNode(self::INDEX_HOST)
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode(self::INDEX_PORT)
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
            ->end();

        return $node;
    }
}
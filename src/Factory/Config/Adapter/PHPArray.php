<?php

namespace Cache\Factory\Config\Adapter;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class PHPArray extends AbstractConfig
{

    const INDEX_LIMIT           = 'limit';

    const INDEX_CACHE_ARRAY     = 'cache';

    /**
     * @inheritdoc
     */
    public function getAdapterConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $node        = $treeBuilder->root($this->getAdapterName());

        $node
            ->children()
                ->scalarNode(self::INDEX_LIMIT)
                    ->defaultValue(null)
                ->end()
                ->arrayNode(self::INDEX_CACHE_ARRAY)
                    ->prototype('scalar')
                    ->end()
                ->end()
            ->end();

        return $node;
    }
}

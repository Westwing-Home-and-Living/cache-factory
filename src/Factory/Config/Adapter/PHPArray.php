<?php

namespace Cache\Factory\Config\Adapter;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class PHPArray extends AbstractConfig
{
    /**
     * @inheritdoc
     */
    public function getAdapterConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $node        = $treeBuilder->root($this->getAdapterName());

        return $node;
    }
}

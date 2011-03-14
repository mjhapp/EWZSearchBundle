<?php

namespace EWZ\Bundle\SearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * configuration structure.
 */
class Configuration
{
    /**
     * Generates the configuration tree.
     *
     * @return \Symfony\Component\Config\Definition\NodeInterface
     */
    public function getConfigTree()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ewz_search', 'array');

        $rootNode
            ->scalarNode('analyzer')->end()
            ->scalarNode('path')->end()
        ;

        return $treeBuilder->buildTree();
    }
}

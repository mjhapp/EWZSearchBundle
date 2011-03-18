<?php

namespace EWZ\Bundle\SearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * configuration structure.
 */
class Configuration
{
    /**
     * Generates the configuration tree.
     *
     * @return \Symfony\Component\Config\Definition\ArrayNode The config tree
     */
    public function getConfigTree()
    {
        $tree = new TreeBuilder();

        $tree->root('ewz_search')
            ->children()
                ->scalarNode('analyzer')->end()
                ->scalarNode('path')->end()
            ->end()
        ;

        return $tree->buildTree();
    }
}

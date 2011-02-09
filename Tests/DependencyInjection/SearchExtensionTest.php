<?php

namespace Bundle\SearchBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Bundle\SearchBundle\DependencyInjection\SearchExtension;

class SearchExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testConfigLoad()
    {
        $container = $this->getContainer();
        $loader = new SearchExtension();

        $loader->luceneLoad(array(), $container);
        $this->assertEquals('Bundle\\SearchBundle\\Lucene\\LuceneSearch', $container->getParameter('search.lucene.search.class'), '->luceneLoad() loads the lucene.xml file if not already loaded');
    }
}

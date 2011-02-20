<?php

namespace EWZ\SearchBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class EWZSearchExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        foreach ($configs as $config) {
            $this->doConfigLoad($config, $container);
        }
    }

    /**
     * Loads the lucene configuration.
     *
     * @param array            $config    An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    protected function doConfigLoad(array $config, ContainerBuilder $container)
    {
        if (!$container->hasDefinition('search.lucene')) {
            $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
            $loader->load('lucene.xml');
        }

        if (isset($config['analyzer'])) {
            $container->setParameter('lucene.analyzer', $config['analyzer']);
        }

        if (isset($config['path'])) {
            $container->setParameter('lucene.index.path', $config['path']);
        }
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }

    /**
     * Returns the namespace to be used for this extension (XML namespace).
     *
     * @return string The XML namespace
     */
    public function getNamespace()
    {
        return 'http://www.symfony-project.org/schema/dic/ewz/search';
    }
}

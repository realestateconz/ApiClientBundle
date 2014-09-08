<?php

namespace RealestateCoNz\ApiClientBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Definition;

/**
 *
 */
class RealestateCoNzApiClientExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        foreach($config as $name => $clientConfig) {
            $clientDefinition = new Definition();
            $clientDefinition->setClass(isset($clientConfig['class']) ? $clientConfig['class'] : "RealestateCoNz_Api_Client");
            $clientDefinition->addArgument($clientConfig['private_key']);
            $clientDefinition->addArgument($clientConfig['public_key']);
            $clientDefinition->addArgument($clientConfig['version']);
            $clientDefinition->addArgument($clientConfig['host']);
            
            $container->setDefinition("realestateconz_apiclient.client.$name", $clientDefinition);
        }
    }
    
    /**
     * @codeCoverageIgnore
     */
    public function getNamespace()
    {
        return 'realestateconz_apiclient';
    }
}

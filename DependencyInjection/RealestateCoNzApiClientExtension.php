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
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        foreach($config as $name => $clientConfig) {
            $clientDefinition = new Definition();
            $clientDefinition->setClass(isset($clientConfig['class']) ? $clientConfig['class'] : "RealestateCoNz_Api_Client");
            
            $clientDefinition->addArgument($clientConfig['private_key']);
            $clientDefinition->addArgument($clientConfig['public_key']);
            $clientDefinition->addArgument(isset($clientConfig['version']) ? $clientConfig['version'] : $container->getParameter("realestateconz_apiclient.client.version"));
            $clientDefinition->addArgument(isset($clientConfig['host']) ? $clientConfig['host'] : $container->getParameter("realestateconz_apiclient.client.host"));
            
            $container->setDefinition("realestateconz_apiclient.client.$name", $clientDefinition);
        }
        

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }
    
    /**
     * @codeCoverageIgnore
     */
    public function getNamespace()
    {
        return 'realestateconz_apiclient';
    }
}

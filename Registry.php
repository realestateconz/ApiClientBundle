<?php


namespace RealestateCoNz\ApiClientBundle;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * References all clients in a give Container
 *
 */
class Registry implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     *
     * @var array
     */
    protected $clients = array();
    
    /**
     * @inheritdoc
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * Get Api Client by its name
     *
     * @param string $alias The alias
     *
     * @return 
     */
    public function getClient($alias = "default")
    {
        if(!isset($this->clients[$alias])) {
            return $this->container->get('realestateconz_apiclient.client.' . $alias);
        }
        

        return $this->clients[$alias];
    }
    
}

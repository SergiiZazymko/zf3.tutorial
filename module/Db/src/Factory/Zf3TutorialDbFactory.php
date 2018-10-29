<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 29.10.18
 * Time: 20:19
 */

namespace Db\Factory;


use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterServiceFactory;

/**
 * Class Zf3TutorialDbFactory
 * @package Db\Factory
 */
class Zf3TutorialDbFactory extends AdapterServiceFactory
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Adapter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        return new Adapter($config['zf3_db']);
    }
}

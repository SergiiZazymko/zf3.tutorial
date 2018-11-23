<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Album\Factory;

use Album\Controller\AlbumDoctrineController;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AlbumDoctrineControllerFactory
 * @package Album\Factory
 */
class AlbumDoctrineControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AlbumDoctrineController|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AlbumDoctrineController(
            $container->get(EntityManager::class)
        );
    }
}

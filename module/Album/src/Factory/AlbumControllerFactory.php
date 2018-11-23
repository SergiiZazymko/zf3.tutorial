<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 27.10.18
 * Time: 23:14
 */

namespace Album\Factory;

use Album\Controller\AlbumController;
use Album\Model\Album\AlbumRepository;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AlbumControllerFactory
 * @package Album\Factory
 */
class AlbumControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AlbumController|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AlbumController(
            $container->get(AlbumRepository::class)
        );
    }
}

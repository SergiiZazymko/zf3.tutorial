<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Album\Controller;

use Album\Model\Album\AlbumRepository;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class DbControllerFactory
 * @package Album\Controller
 */
class DbControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return DbController|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new DbController(
            $container->get(AlbumRepository::class)
        );
    }
}
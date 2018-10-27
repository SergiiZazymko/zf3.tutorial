<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 27.10.18
 * Time: 21:46
 */

namespace Album\Model\Album;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class AlbumRepositoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // TODO: Implement __invoke() method.
    }

}

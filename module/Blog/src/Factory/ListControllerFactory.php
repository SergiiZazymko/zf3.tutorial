<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Blog\Factory;

use Blog\Controller\ListController;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Blog\Model\PostRepositoryInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ListControllerFactory
 * @package Blog\Factory
 */
class ListControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ListController|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ListController(
            $container->get(PostRepositoryInterface::class)
        );
    }
}

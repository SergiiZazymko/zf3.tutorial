<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Album\Initializer;

use Album\Controller\EntityManagerAwareInterface;
use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Initializer\InitializerInterface;

/**
 * Class EntityManagerInitializer
 * @package Album\Initializer
 */
class EntityManagerInitializer implements InitializerInterface
{
    /**
     * @param ContainerInterface $container
     * @param object $instance
     */
    public function __invoke(ContainerInterface $container, $instance)
    {
        if ($instance instanceof EntityManagerAwareInterface) {
            $instance->setEntityManager(
                $container->get(EntityManager::class)
            );
        }
    }
}

<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Blog\Factory;

use Blog\Model\PostEntity;
use Blog\Model\ZendDbSqlRepository;
use Db\Adapter\Zf3Adapter;
use Interop\Container\ContainerInterface;
use Zend\Hydrator\Reflection as ReflectionHydrator;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ZendDbSqlRepositoryFactory
 * @package Factory
 */
class ZendDbSqlRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ZendDbSqlRepository|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ZendDbSqlRepository(
            $container->get(Zf3Adapter::class),
            new ReflectionHydrator,
            new PostEntity('', '')
        );
    }
}

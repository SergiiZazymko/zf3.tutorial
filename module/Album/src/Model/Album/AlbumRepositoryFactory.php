<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 27.10.18
 * Time: 21:46
 */

namespace Album\Model\Album;

use Db\Adapter\Zf3Adapter;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Stdlib\Db\Table;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class AlbumRepositoryFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AlbumRepository|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var AdapterInterface $adapter */
        $adapter = $container->get(Zf3Adapter::class);

        /** @var ResultSet $resultSetPrototype */
        $resultSetPrototype = new ResultSet;
        $resultSetPrototype->setArrayObjectPrototype(new AlbumEntity);

        /** @var TableGatewayInterface $tableGateway */
        $tableGateway = new TableGateway(
            Table::ALBUM,
            $adapter,
            null,
            $resultSetPrototype
        );

        return new AlbumRepository(
            $tableGateway,
            AlbumCollection::class
        );
    }
}

<?php
/**
 * Access protected
 * User: Sergii Zazymko
 * Date: 25.10.18
 * Time: 18:41
 */

namespace Album;

use Album\Controller\AlbumController;
use Album\Model\Album\AlbumRepository;
use Stdlib\Db\Table;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 * @package Album
 */
class Module implements ConfigProviderInterface
{
    /**
     * @return array|mixed|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * @return array
     */
    //public function getServiceConfig()
    //{
    //    return [
    //        'factories' => [
    //            AlbumRepository::class => function($container) {
    //                /** @var AdapterInterface $adapter */
    //                $adapter = $container->get(AdapterInterface::class);
    //
    //                /** @var ResultSet $resultSetPrototype */
    //                $resultSetPrototype = new ResultSet;
    //                $resultSetPrototype->setArrayObjectPrototype(new Model\Album\AlbumEntity);
    //
    //                /** @var TableGatewayInterface $tableGateway */
    //                $tableGateway = new TableGateway(
    //                    Table::ALBUM,
    //                    $adapter,
    //                    null,
    //                    $resultSetPrototype
    //                );
    //
    //                return new AlbumRepository($tableGateway);
    //            },
    //        ],
    //    ];
    //}

    /**
     * @return array
     */
    //public function getControllerConfig()
    //{
    //    return [
    //        'factories' => [
    //            AlbumController::class => function($container) {
    //                return new AlbumController(
    //                    $container->get(AlbumRepository::class)
    //                );
    //            },
    //        ],
    //    ];
    //}
}

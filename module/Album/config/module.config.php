<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 25.10.18
 * Time: 19:07
 */

namespace Album;

use Album\Controller\DbControllerFactory;
use Album\Factory\AlbumControllerFactory;
use Album\Factory\AlbumDoctrineControllerFactory;
use Album\Initializer\EntityManagerInitializer;
use Album\Model\Album\AlbumRepository;
use Album\Model\Album\AlbumRepositoryFactory;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'album' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/album[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '\d+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AlbumController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'album-doctrine' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/album-doctrine[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id' => '\d+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AlbumDoctrineController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'db' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/db/:action',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\DbController::class,
                        //'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            // Controller\AlbumController::class => InvokableFactory::class,
            Controller\AlbumController::class => AlbumControllerFactory::class,
            Controller\AlbumDoctrineController::class => AlbumDoctrineControllerFactory::class,
            Controller\AlbumDoctrineController::class => InvokableFactory::class,
            Controller\DbController::class => DbControllerFactory::class,
        ],
        'initializers' => [
            EntityManagerInitializer::class => new EntityManagerInitializer,
        ],
    ],
    'service_manager' => [
        'factories' => [
            AlbumRepository::class => AlbumRepositoryFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
    'doctrine' => array(
        'driver' => array(
            'album_entity' => array(
                'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Album\Entity' => 'album_entity',
                )
            )
        )
    ),
];

<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 25.10.18
 * Time: 19:07
 */

namespace Album;

use Album\Controller\AlbumControllerFactory;
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
        ],
    ],
    'controllers' => [
        'factories' => [
            // Controller\AlbumController::class => InvokableFactory::class,
            Controller\AlbumController::class => AlbumControllerFactory::class,
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
];

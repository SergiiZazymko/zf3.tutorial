<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Blog;

use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'blog' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/blog',
                    'defaults' => [
                        'controller' => Controller\ListController::class,
                        'action' => 'index',
                    ],
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Blog',
                'title' => 'Blog page',
                'route' => 'blog',
                'order' => 3,
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\ListController::class => Factory\ListControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'aliases' => [
            Model\PostRepositoryInterface::class => Model\ZendDbSqlRepository::class,
        ],
        'factories' => [
            Model\PostRepository::class => InvokableFactory::class,
            Model\ZendDbSqlRepository::class => Factory\ZendDbSqlRepositoryFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'blog' => __DIR__ . '/../view',
        ],
    ],
];

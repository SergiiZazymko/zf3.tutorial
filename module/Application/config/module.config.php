<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'showMessages' => \Album\View\Helper\ShowMessages::class,
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Home',
                'title' => 'Home page of application',
                'route' => 'home',
                'order' => 1,
            ],
            [
                'label' => 'Album',
                'title' => 'List of all albums',
                'route' => 'album',
                'order' => 2,
                'pages' => [
                    [
                        'label' => 'Add',
                        'title' => 'Add new album',
                        'route' => 'album',
                        'action' => 'add',
                    ],
                    [
                        'label' => 'Edit',
                        'title' => 'Edit album',
                        'route' => 'album',
                        'action' => 'edit',
                    ],
                    [
                        'label' => 'Delete',
                        'title' => 'Delete album',
                        'route' => 'album',
                        'action' => 'delete',
                    ],
                ],
            ],
            [
                'label' => 'Album(Doc)',
                'title' => 'List of all albums',
                'route' => 'album-doctrine',
                'order' => 5,
                'pages' => [
                    [
                        'label' => 'Add',
                        'title' => 'Add new album',
                        'route' => 'album-doctrine',
                        'action' => 'add',
                    ],
                    [
                        'label' => 'Edit',
                        'title' => 'Edit album',
                        'route' => 'album-doctrine',
                        'action' => 'edit',
                    ],
                    [
                        'label' => 'Delete',
                        'title' => 'Delete album',
                        'route' => 'album-doctrine',
                        'action' => 'delete',
                    ],
                ],
            ],
            [
                'label' => 'Word',
                'Title' => 'Download word template',
                'route' => 'word',
                'order' => 4,
            ],
        ],
    ],
];

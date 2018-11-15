<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Word;

use Word\Controller\WordController;
use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'word' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/word',
                    'defaults' => [
                        'controller' => Controller\WordController::class,
                        'action' => 'index'
                    ],
                ],
            ],
        ],
    ],
    'console' => [
        'router' => [
            'routes' => [
                'word' => [
                    'type' => Literal::class,
                    'options' => [
                        'route' => 'word',
                        'defaults' => [
                            'controller' => Controller\WordController::class,
                            'action' => 'index'
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            WordController::class => InvokableFactory::class,
        ],
    ],
];
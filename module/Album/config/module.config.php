<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 25.10.18
 * Time: 19:07
 */

namespace Album;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\AlbumController::class => InvokableFactory::class
        ],
    ],
    'template_path_stack' => [
        'album' => __DIR__ . '/../view'
    ],
];

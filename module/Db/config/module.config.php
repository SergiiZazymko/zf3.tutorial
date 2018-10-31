<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 29.10.18
 * Time: 20:17
 */

namespace Db;

use Db\Adapter\Zf3Adapter;

return [
    'service_manager' => [
        'factories' => [
            Zf3Adapter::class => Factory\Zf3AdapterFactory::class,
        ],
    ],
];

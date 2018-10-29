<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 29.10.18
 * Time: 20:17
 */

namespace Db;

return [
    'service_manager' => [
        'factories' => [
            'zf3_db' => Factory\Zf3TutorialDbFactory::class,
        ],
    ],
];

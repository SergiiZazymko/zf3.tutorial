<?php
/**
 * Access protected
 * Author: Sergii Zazymko
 * Date: 29.10.18
 * Time: 20:28
 */

namespace Db;


use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 * @package Db
 */
class Module implements ConfigProviderInterface
{
    /**
     * @return array|string|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}

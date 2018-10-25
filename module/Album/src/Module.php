<?php
/**
 * Access protected
 * User: Sergii Zazymko
 * Date: 25.10.18
 * Time: 18:41
 */

namespace Album;

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
}

<?php
/**
 * @access protected
 * @author Sergiy Zazymko <sergiy.zazymko@gns-it.com>
 */

namespace Word;

use Zend\Console\Adapter\AdapterInterface;
use Zend\Console\Console;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 * @package Word
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

    /**
     * @param AdapterInterface $console
     * @return array
     */
    public function getConsoleUsage(Console $console)
    {
        return [
            'word' => 'Generate word file from template',
        ];
    }
}

<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */
return [
    'Zend\Paginator',
    'Zend\Navigation',
    'Zend\Session',
    'Zend\Mvc\I18n',
    'Zend\Log',
    'Zend\Form',
    'Zend\Db',
    'Zend\Router',
    'Zend\Validator',
    'Application',
    'Blog',
    'Currency',
    // Additional modules to include when in development mode
    'modules' => [
        'ZendDeveloperTools',
    ],
    // Configuration overrides during development mode
    'module_listener_options' => [
        'config_glob_paths' => [realpath(__DIR__) . '/autoload/{,*.}{global,local}-development.php'],
        'config_cache_enabled' => false,
        'module_map_cache_enabled' => false,
    ],
];

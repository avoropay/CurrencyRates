<?php
namespace Exchange;

use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\ExchangeController::class => InvokableFactory::class,
        ],
    ],

    'router' => [
        'routes' => [
            'exchange' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/exchange[/:action]',
                    'defaults' => [
                        'controller' => Controller\ExchangeController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'exchange' => __DIR__ . '/../view',
        ],
    ],
];
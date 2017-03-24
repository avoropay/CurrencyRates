<?php
namespace Currency;

use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'currency' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/currency[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\CurrencyController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'currency' => __DIR__ . '/../view',
        ],
    ],
];
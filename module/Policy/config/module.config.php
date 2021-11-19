<?php

namespace Policy;

use Policy\Controller\PolicyController;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            Controller\PolicyController::class => InvokableFactory::class,
        ],
    ],
    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'policy' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/policy[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PolicyController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'album' => __DIR__ . '/../view',
        ],
    ],
];
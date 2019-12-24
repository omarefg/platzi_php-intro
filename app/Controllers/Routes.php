<?php

namespace App\Controllers;

class Routes {
    private $routes = [
        [
            'path' => '/php-intro/',
            'methods' => [
                [
                    'method' => 'get',
                    'name' => 'index',
                    'items' => [
                        'controller' => 'App\Controllers\IndexController',
                        'action' => 'indexAction'
                    ]
                ]
            ]
        ],
        [
            'path' => '/php-intro/add-job/',
            'methods' => [
                [
                    'method' => 'get',
                    'name' => 'add-job',
                    'items' => [
                        'controller' => 'App\Controllers\JobController',
                        'action' => 'getAddJobAction',
                        'auth' => true
                    ]
                ],
                [
                    'method' => 'post',
                    'name' => 'save-job',
                    'items' => [
                        'controller' => 'App\Controllers\JobController',
                        'action' => 'getAddJobAction',
                        'auth' => true
                    ]
                ]
            ]
        ],
        [
            'path' => '/php-intro/add-project/',
            'methods' => [
                [
                    'method' => 'get',
                    'name' => 'add-project',
                    'items' => [
                        'controller' => 'App\Controllers\ProjectController',
                        'action' => 'getAddProjectAction',
                        'auth' => true
                    ]
                ],
                [
                    'method' => 'post',
                    'name' => 'save-project',
                    'items' => [
                        'controller' => 'App\Controllers\ProjectController',
                        'action' => 'getAddProjectAction',
                        'auth' => true
                    ]
                ]
            ]
        ],
        [
            'path' => '/php-intro/add-user/',
            'methods' => [
                [
                    'method' => 'get',
                    'name' => 'add-user',
                    'items' => [
                        'controller' => 'App\Controllers\UserController',
                        'action' => 'getAddUserAction',
                        'auth' => true
                    ]
                ],
                [
                    'method' => 'post',
                    'name' => 'save-user',
                    'items' => [
                        'controller' => 'App\Controllers\UserController',
                        'action' => 'getAddUserAction',
                        'auth' => true
                    ]
                ]
            ]
        ],
        [
            'path' => '/php-intro/login/',
            'methods' => [
                [
                    'method' => 'get',
                    'name' => 'login',
                    'items' => [
                        'controller' => 'App\Controllers\AuthController',
                        'action' => 'getLogin'
                    ]
                ]
            ]
        ],
        [
            'path' => '/php-intro/auth/',
            'methods' => [
                [
                    'method' => 'post',
                    'name' => 'auth',
                    'items' => [
                        'controller' => 'App\Controllers\AuthController',
                        'action' => 'postLogin'
                    ]
                ]
            ]
        ],
        [
            'path' => '/php-intro/admin/',
            'methods' => [
                [
                    'method' => 'get',
                    'name' => 'admin',
                    'items' => [
                        'controller' => 'App\Controllers\AdminController',
                        'action' => 'getIndex',
                        'auth' => true
                    ]
                ]
            ]
        ],
        [
            'path' => '/php-intro/logout/',
            'methods' => [
                [
                    'method' => 'get',
                    'name' => 'logout',
                    'items' => [
                        'controller' => 'App\Controllers\AuthController',
                        'action' => 'getLogout'
                    ]
                ]
            ]
        ]
    ];

    public function getRoutes() {
        return $this->routes;
    }
}


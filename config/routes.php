<?php

use Jgut\Slim\Controller\Resolver;

$controllers = [
    'App\Controllers\UserController',
    'App\Controllers\AuthController',
];

foreach (Resolver::resolve($controllers) as $controller => $callback) {
    $container[$controller] = $callback;
}

$app->get('/', function () {
    return 'probe';
});

/**
 *  API
 */
$app->group('/api', function () use ($app) {
    /** Confirm */
    $app->get('/confirm/{confirm_code}', 'App\Controllers\UserController:confirm')->setName('confirm');

    /** Login **/
    $app->post('/login', 'App\Controllers\AuthController:login');

    /** User **/
    $app->group('/users', function () use ($app) {
        $app->group('', function () {
            $this->get('', 'App\Controllers\UserController:index');
            $this->post('', 'App\Controllers\UserController:post');
        });

        $app->group('/{id:[0-9]+}', function () {
            $this->get('', 'App\Controllers\UserController:show');
            $this->put('', 'App\Controllers\UserController:update');
            $this->delete('', 'App\Controllers\UserController:update');
        });
    });
});
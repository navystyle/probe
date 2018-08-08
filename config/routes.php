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
 *  API routes
 */
$app->group('/api', function () use ($app) {

    /** Auth (except jwt) **/
    $app->group('/auth', function () {
        /** Register **/
        $this->post('', 'App\Controllers\AuthController:store');

        /** Login **/
        $this->post('/login', 'App\Controllers\AuthController:login');

        /** Logout **/
        $this->get('/logout', 'App\Controllers\AuthController:logout');

        /** Confirm **/
        $this->get('/confirm/{confirm_code}', 'App\Controllers\AuthController:confirm');

        /** refresh token **/
        $this->post('/token-refresh', 'App\Controllers\AuthController:tokenRefresh');
    });

    /** Users **/
    $app->group('/users', function () use ($app) {
        $app->group('', function () {
            $this->get('', 'App\Controllers\UserController:index');
        });

        $app->group('/{id:[0-9]+}', function () {
            $this->get('', 'App\Controllers\UserController:show');
            $this->put('', 'App\Controllers\UserController:update');
            $this->delete('', 'App\Controllers\UserController:update');
        });
    });
});
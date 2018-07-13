<?php

use Jgut\Slim\Controller\Resolver;

$controllers = [
    'App\Controllers\UserController'
];

foreach (Resolver::resolve($controllers) as $controller => $callback) {
    $container[$controller] = $callback;
}

$app->group('/api/users', function () use ($app) {
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
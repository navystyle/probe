<?php
/**
 * Slim annotations router routes cache file, self generated on 2018-07-08T15:34:29+09:00
 */

$this->map(['GET'], '/users', function($request, $response, $args) { return $this->triggerControllerAction('App\Controllers\UserController', 'indexAction', $args); })->setName('users');
$this->map(['GET'], '/users/{id:[0-9]+}', function($request, $response, $args) { return $this->triggerControllerAction('App\Controllers\UserController', 'showAction', $args); })->setName('users.show');
$this->map(['POST'], '/users', function($request, $response, $args) { return $this->triggerControllerAction('App\Controllers\UserController', 'postAction', $args); })->setName('users.post');

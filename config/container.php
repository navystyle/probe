<?php

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

# logger
$container['logger'] = function () use ($app, $conf) {
    $logger_conf = $conf['settings.logger'];

    $logger = new Logger($logger_conf['name']);

    $formatter = new LineFormatter(
        "[%datetime%] [%level_name%]: %message% %context%\n",
        null,
        true,
        true
    );

    /* Log to timestamped files */
    $rotating = new RotatingFileHandler($logger_conf['path'], 0, $logger_conf['level']);
    $rotating->setFormatter($formatter);
    $logger->pushHandler($rotating);

    return $logger;
};

# router
$container['router'] = function () use ($app, $conf) {
    return new \Ergy\Slim\Annotations\Router($app,
        $conf['app.controller_dir'], // Path to controller files, will be scanned recursively
        $conf['app.router_cache_dir'] // Path to annotations router cache files, must be writeable by web server, if it doesn't exist, router will attempt to create it
    );
};

# view
/*$container['view'] = function ($container) use ($conf) {
    $view = new \Slim\Views\Twig(
        $conf['app.template.dir'],
        [
            'cache' => $conf['app.template.cache'],
            'debug' => $conf['app.template.debug'],
            'auto_reload' => $conf['app.template.auto_reload'],
        ]
    );
    $view->addExtension(
        new \Slim\Views\TwigExtension(
            $container['router'],
            $container['request']->getUri()
        )
    );
    $view->addExtension(
        new Twig_Extension_Debug()
    );
    $view->offsetSet('userGlobalData', App::getUser());

    return $view;
};
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};*/

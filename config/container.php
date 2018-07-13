<?php

use App\ApiErrorHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Tuupola\Middleware\JwtAuthentication;

# logger
$container['logger'] = function () use ($conf) {
    $logger_conf = $conf['settings.logger'];

    $logger = new Logger($logger_conf['name']);

    $formatter = new LineFormatter(
        "[%datetime%] [%level_name%]: %message% %context%\n",
        null,
        true,
        true
    );

    $rotating = new RotatingFileHandler($logger_conf['path'], 0, $logger_conf['level']);
    $rotating->setFormatter($formatter);
    $logger->pushHandler($rotating);

    return $logger;
};

# error handler
$container["errorHandler"] = function ($container) {
    return new ApiErrorHandler($container["logger"]);
};

# php error handler
$container["phpErrorHandler"] = function ($container) {
    return $container["errorHandler"];
};

# jwt
$container["JwtAuthentication"] = function ($container) use ($conf) {
    return new JwtAuthentication([
        'path' => '/api2',
//        'ignore' => ['/api/users/get-test', '/api/users/post-test'],
        'logger' => $container['logger'],
        'attribute' => 'decoded_token_data',
        'secret' => $conf['jwt.secret'],
        'secure' => true,
        'relaxed' => ['localhost', $conf['app.host']],
        'algorithm' => [
            $conf['jwt.algorithm']
        ],
        'error' => function ($response, $args) {
            $data["status"] = 403;
            $data["message"] = $args["message"];
            return $response
                ->withHeader("Content-Type", "application/json")
                ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        },
    ]);
};

# validator
$container['validator'] = function () {
    return new App\Validation\Validator();
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

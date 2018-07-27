<?php

use App\ApiErrorHandler;
use App\Token;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Tuupola\Middleware\JwtAuthentication;

# logger
$container['logger'] = function () use ($conf) {
    $logger_conf = $conf['settings.logger'];

    $logger = new Logger($logger_conf['name']);

    $formatter = new LineFormatter(
        '[%datetime%] [%level_name%]: %message% %context%\n',
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
$container['errorHandler'] = function ($container) {
    return new ApiErrorHandler($container['logger']);
};

# php error handler
$container['phpErrorHandler'] = function ($container) {
    return $container['errorHandler'];
};

# token
$container['token'] = function ($container) {
    return new Token;
};

# jwt
$container['JwtAuthentication'] = function ($container) use ($conf) {
    return new JwtAuthentication([
        'path' => '/api',
        'ignore' => ['/api/auth/'],
        'logger' => $container['logger'],
        'attribute' => false,
        'secret' => $conf['settings.jwt.secret'],
        'secure' => true,
        'relaxed' => ['localhost', $conf['app.host']],
        'algorithm' => [
            $conf['settings.jwt.algorithm']
        ],
        'error' => function ($response, $args) {
            $data['status'] = 403;
            $data['message'] = $args['message'];
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
        },
        'before' => function ($request, $arguments) use ($container) {
            $container['token']->populate($arguments['decoded']);
        }
    ]);
};

# validator
$container['validator'] = function () {
    return new App\Validation\Validator();
};

# view
$container['view'] = function ($container) use ($conf) {
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
    $view->offsetSet('userGlobalData', $container['token']->getUser());

    return $view;
};

# flash
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

# mail
$container['mailer'] = function ($container) use ($conf) {
    $twig = $container['view'];
    $mailer = new \Anddye\Mailer\Mailer($twig, $conf['mail']);

    // Set the details of the default sender
    $mailer->setDefaultFrom($conf['mail.from_email'], $conf['mail.from_name']);

    return $mailer;
};
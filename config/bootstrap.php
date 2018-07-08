<?php
#session start
session_start();

#dependencies included via composer autoload
require '../vendor/autoload.php';

$conf = \Noodlehaus\Config::load(__DIR__ . DIRECTORY_SEPARATOR . 'settings.php');
$propel_conf = \Noodlehaus\Config::load(__DIR__ . DIRECTORY_SEPARATOR . 'propel.php');
$runtime_conf = $propel_conf['propel.runtime'];

#encoding
mb_internal_encoding($conf['app.encoding.mb_internal_encoding']);
mb_http_output($conf['app.encoding.mb_http_output']);

#timezone
date_default_timezone_set($conf['app.timezone']);

#Database Configuration
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass($conf['app.namespace'], 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration($propel_conf['propel.database.connections.'.$conf['app.namespace']] + [$propel_conf['propel.paths']]);
$manager->setName($conf['app.namespace']);
$serviceContainer->setConnectionManager($conf['app.namespace'], $manager);
$serviceContainer->setDefaultDatasource($conf['app.namespace']);
// set loggers
$has_default_logger = false;
if ( isset($runtime_conf['log']) ) {
    $has_default_logger = array_key_exists('defaultLogger', $runtime_conf['log']);
    foreach ($runtime_conf['log'] as $logger_name => $logger_conf) {
        $serviceContainer->setLoggerConfiguration($logger_name, $logger_conf);
    }
}

/*if ( ! $has_default_logger) {
    $serviceContainer->setLogger('defaultLogger', new Monolog\Logger());
}*/

\Propel\Runtime\Propel::setServiceContainer($serviceContainer);
# End of Propel Database

#SLIM instantiate
$settings =  [
    'settings' => [
        'displayErrorDetails' => true,
        'logger' => [
            'name' => 'slim-app',
            'level' => Monolog\Logger::DEBUG,
            'path' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'storage/logs/app.log',
        ],
        'default_limit' => $conf['app.default_limit'],
    ],
];

$app = new \Slim\App($settings);
$container = $app->getContainer();
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
    $view->offsetSet('userGlobalData', App::getUser());

    return $view;
};
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};
$container['router'] = function() use ($app, $conf) {
    return new \Ergy\Slim\Annotations\Router($app,
        $conf['app.controller_dir'], // Path to controller files, will be scanned recursively
        $conf['app.router_cache_dir'] // Path to annotations router cache files, must be writeable by web server, if it doesn't exist, router will attempt to create it
    );
};
#End of SLIM Instance
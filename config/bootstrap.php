<?php
session_start();

require '../vendor/autoload.php';

$conf = \Noodlehaus\Config::load(__DIR__ . DIRECTORY_SEPARATOR . 'settings.php');
$propel_conf = \Noodlehaus\Config::load(__DIR__ . DIRECTORY_SEPARATOR . 'propel.php');
$runtime_conf = $propel_conf['propel.runtime'];

#encoding
mb_internal_encoding($conf['app.encoding.mb_internal_encoding']);
mb_http_output($conf['app.encoding.mb_http_output']);

#timezone
date_default_timezone_set($conf['app.timezone']);

$app = new \Slim\App(['settings' => $conf['settings']]);
$container = $app->getContainer();

# database configuration
require __DIR__ . DIRECTORY_SEPARATOR . 'database.php';

# container
require __DIR__ . DIRECTORY_SEPARATOR . '/container.php';

# routes
require __DIR__ . DIRECTORY_SEPARATOR . '/routes.php';

# middleware
require __DIR__ . DIRECTORY_SEPARATOR . '/middleware.php';
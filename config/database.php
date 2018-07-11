<?php

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

\Propel\Runtime\Propel::setServiceContainer($serviceContainer);
# End of Propel Database
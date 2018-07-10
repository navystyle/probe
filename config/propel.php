<?php
$conf = \Noodlehaus\Config::load(__DIR__ . DIRECTORY_SEPARATOR . 'settings.php');

return [
    'propel' => [
        ### Directories and Filenames ###
        'paths' => [
            # Directory where the project files (`schema.xml`, etc.) are located.
            # Default value is current path #

            # The directory where Propel expects to find your `schema.xml` file.
            'schemaDir' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'propel',

            # The directory where Propel should output generated object model classes.
            'phpDir' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src/App/Models/',

            # The directory where Propel should output the compiled runtime configuration.
            'phpConfDir' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config/propel',

            # The directory where Propel should output the generated DDL (or data insert statements, etc.)
            'sqlDir' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'propel',

            # Directory in which your composer.json resides
            'composerDir' => dirname(__DIR__) . DIRECTORY_SEPARATOR,
        ],

        'database' => [
            'connections' => [
                $conf['app.namespace'] => [
                    'adapter' => 'mysql',
                    'dsn' => 'mysql:host=' . $conf['app.db.host'] . ';port=' . $conf['app.db.port'] . ';dbname=' . $conf['app.db.name'],
                    'user' => $conf['app.db.username'],
                    'password' => $conf['app.db.password'],
                    'settings' => [
                        'charset' => $conf['app.db.charset'],
                        'queries' => [],
                    ],
                    'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
                    'model_paths' =>
                        [
                            0 => 'src',
                            1 => 'vendor',
                        ],
                ]
            ]
        ],

        ## Reverse settings
        'reverse' => [
            # The connection to use to reverse the database
            'connection' => $conf['app.namespace'],

            # Reverse parser class can be different from migration one
            # If you leave this property blank, Propel looks for an appropriate parser class, based on platform: i.e.
            # if the platform is `MysqlPlatform` then parser is `\Propel\Generator\Reverse\MysqlSchemaParser`
            'parserClass' => '\\Propel\\Generator\\Reverse\\MysqlSchemaParser', //string
        ],

        ## Runtime settings ##
        'runtime' => [
            'defaultConnection' => $conf['app.namespace'],
            # Datasources as defined in database.connections
            # This section affects config:convert command
            'connections' => [
                $conf['app.namespace'],
            ],
            ## Log and loggers definitions ##
            # For `type` and `level` options see Monolog documentation https://github.com/Seldaek/monolog
            'log' => [
                'defaultLogger' => [
                    'type' => 'stream', // stream | rotating_file | syslog
                    'path' => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'storage/logs/propel.log', //string
                    'level' => 300, //integer
                ],
                /*'defaultLogger' => [
                    'type' => 'rotating_file', // stream | rotating_file | syslog
                    'path' => require, //string
                    'max_files' =>  null, //integer
                    'level' => null, //integer
                ],*/
                /*'defaultLogger' => [
                    'type' => 'syslog', // stream | rotating_file | syslog
                    'ident' => require, //string
                    'facility' => null, //mixed
                    'level' => null, //integer
                    'bubble' => null, //boolean
                ],
                */
            ],
            ## Profiler configuration ##
            # To enable the profiler for a connection, set the `classname` option to \Propel\Runtime\Connection\ProfilerConnectionWrapper
            # see: http://propelorm.org/documentation/07-logging.html
            'profiler' => [
                'classname' => \Propel\Runtime\Util\Profiler::class,
                'slowTreshold' => 0.1,
                'details' => [
                    /*
                    'time' => [
                        'name'      => 'Time',
                        'precision' => 3,
                        'pad' => 8,
                    ],
                    'mem' => [
                        'name'      => 'Memory',
                        'precision' => 3,
                        'pad' => 8,
                    ],
                    'memDelta' => [
                        'name'      => 'Memory Delta',
                        'precision' => 3,
                        'pad' => 8,
                    ],
                    'memPeak' => [
                        'name'      => 'Memory Peak',
                        'precision' => 3,
                        'pad' => 8,
                    ],
                    */
                ],
                'innerGlue' => ': ',
                'outerGlue' => ' | ',
            ],
        ],
    ]
];

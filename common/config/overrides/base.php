<?php
/**
 * Configuration parameters common to all entry points.
 */
return [
    'name' => 'IT Community',
    // preloading 'log' component
    'preload' => ['log'],
    // i18n settings
    'sourceLanguage' => 'en',
    'language' => 'en',
    // autoloading model and component classes
    'import' => [
        'common.components.*',
        'common.models.*',
        // The following two imports are polymorphic and will resolve against wherever the `basePath` is pointing to.
        // We have components and models in all entry points anyway
        'application.components.*',
        'application.models.*'
    ],
    // application components
    'components' => [
        'db' => [
            'schemaCachingDuration' => PRODUCTION_MODE ? 86400000 : 0, // 86400000 == 60*60*24*1000 seconds == 1000 days
            'enableParamLogging' => !PRODUCTION_MODE,
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ],
        'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '/',
        ],
        'user' => [
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
        ],
        'cache' => extension_loaded('apc')
                ? [
                    'class' => 'CApcCache',
                ]
                : [
                    'class' => 'CDbCache',
                    'connectionID' => 'db',
                    'autoCreateCacheTable' => true,
                    'cacheTableName' => 'cache',
                ],
        'messages' => [
            'basePath' => 'common.messages'
        ],
        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                'logFile' => [
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                    'filter' => 'CLogFilter'
                ],
            ]
        ],
    ]
];
<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

$config = [
    'id' => 'yii2-sentry-log-target',
    'basePath' => __DIR__,
    'bootstrap' => ['log'],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => Rekurzia\Log\SentryTarget::class,
                    'levels' => ['error', 'warning'],
                    'dsn' => 'http://abcdefgh:12345678@apache/90',
                    'includeContextMessage' => true,
                    'options' => [
                        'message_limit' => 2048,
                    ],
                ],
            ]
        ]
    ]
];

(new yii\web\Application($config))->run();

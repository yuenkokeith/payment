<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        /*
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        */
        /*
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => 'server1',
                    'port' => 11211,
                    'weight' => 100,
                ],
               
            ],
        ],
       */
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6380,
            'database' => 0,
        ],
    ],
];

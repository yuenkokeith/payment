<?php
return [
    'components' => [
        
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=outletu1_paymentdb',
            'username' => 'root',
            'password' => '12345678',
            'charset' => 'utf8',
        ],
        /*
        'db' => [
            'class' => 'yii\db\Connection',
            'driverName' => 'sqlsrv',
            'dsn' => 'sqlsrv:Server=ANYONE\SQLEXPRESS;Database=datachart',
            'username' => 'sa',
            'password' => '12345678',
            'charset' => 'utf8'
        ],
        */
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];

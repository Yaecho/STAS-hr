<?php
return [
    'language' => 'zh-CN',
    'timeZone' => 'Asia/shanghai',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=STASdata',
            'username' => 'STASdata',
            'password' => 'o769Vhuyx7FRtzXm',
            'charset' => 'utf8',
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            // 'db' => 'mydb',  // 数据库连接的应用组件ID，默认为'db'.
            // 'sessionTable' => 'my_session', // session 数据表名，默认为'session'.
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'request' => [
            // Enable Yii Validate CSRF Token
            'enableCsrfValidation' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
];

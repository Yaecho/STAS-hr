<?php
return [
    'language' => 'zh-CN',
    //'timeZone' => 'Asia/shanghai',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=STASdata',
            'username' => 'stas',
            'password' => 'o769Vhuyx7FRtzXm',
            'charset' => 'utf8',
        ],
        'dbmb4' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=STASdata',     
            'username' => 'stas',
            'password' => 'o769Vhuyx7FRtzXm',
            'charset' => 'utf8mb4',
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            // 'db' => 'mydb',  // 数据库连接的应用组件ID，默认为'db'.
            // 'sessionTable' => 'my_session', // session 数据表名，默认为'session'.
        ],
        'request' => [
            // Enable Yii Validate CSRF Token
            'enableCsrfValidation' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        //日志配置
        'log' => [
            'targets' => [
                /*
                 *使用文件存储日志
                 */
                [
                     //文件方式存储日志操作对应操作对象
                    'class' => 'yii\log\FileTarget',
                     /* 定义存储日志信息的级别，只有在这个数组的数据才能会使用当前方式存储起来
                      有trace（用于开发调试时记录日志，需要把YII_DEBUG设置为true），
                        error（用于记录不可恢复的错误信息)，
                        warning（用于记录一些警告信息)
                        info(用于记录一些系统行为如管理员操作提示)
                        这些常用的。
                    */
                    'levels' => ['error'],
                    /**
                     * 按类别分类
                     * 默认为空，即所有。yii\* 指所有以 yii\ 开头的类别.
                     */
                    'categories' => [],
                ],
                /*[
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['resumeGet', 'smsRes'],
                    'logFile' => '@app/runtime/logs/frontend/resumeAndSms.log',
                ],*/
            ],
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
];

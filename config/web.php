<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    
    'components' => [
         'mycomponent' => [
                'class' => 'app\components\MyComponent',
            ],
         'common' => [
                'class' => 'app\components\CommonFunction',
            ],
         //'oauthcomponent' => [
         //       'class' => 'app\components\OauthComponent',
         //   ],
         'photocomponent' => [
                'class' => 'app\components\PhotoComponent',
            ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'jamiah@123456',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
         'assetManager' => [
                    'bundles' => [             // you can override AssetBundle configs here
                    'yii\web\JqueryAsset' => [
                                    'sourcePath' => null,
                                    'js' => []
                                            ],
                     'yii\bootstrap\BootstrapPluginAsset' => [
                          'sourcePath' => null,
                                        'js'=>[]
                                    ],
                                ],
            ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            /*'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'phppeerbits@gmail.com',
                'password' => 'php123456',
                'port' => '587',
                'encryption' => 'tls',
            ],*/
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'class'=>'yii\web\UrlManager',
            'showScriptName' => false,
            'rules' => [
                //'site/noticiadetail/<id:\d+>' => 'site/noticiadetail',
                //'site/dicasdetail/<id:\d+>' => 'site/dicasdetail',
                //'site/entrevistadetail/<id:\d+>' => 'site/entrevistadetail',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
    ],
    'params' => $params,
    'timeZone' => 'Europe/London', //Asia/Kolkata',
    'modules' => [
        'gii' => [
          'class' => 'yii\gii\Module', //adding gii module
          //'allowedIPs' => ['127.0.0.1', '::1','192.168.1.*'],  //allowing ip's
        ],
       'debug' => [
            'class' => 'yii\\debug\\Module',
            'allowedIPs' => ['127.0.0.1'],  //allowing ip's
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    //$config['modules']['gii'] = 'yii\gii\Module';
}

return $config;

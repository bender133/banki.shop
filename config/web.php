<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
  'id' => 'basic',
  'basePath' => dirname(__DIR__),
  'bootstrap' => ['log'],
  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm' => '@vendor/npm-asset',
  ],
  'components' => [
    'request' => [
      'parsers' => [
        'application/json' => 'yii\web\JsonParser',
      ],
      // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
      'cookieValidationKey' => 's27tKotPk26CwAqVMxEqQzLqPJQDdPk2',
    ],
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
    'user' => [
      'identityClass' => 'app\models\User',
      'enableAutoLogin' => TRUE,
    ],
    'errorHandler' => [
      'errorAction' => 'site/error',
    ],
    'mailer' => [
      'class' => \yii\symfonymailer\Mailer::class,
      'viewPath' => '@app/mail',
      // send all mails to a file by default.
      'useFileTransport' => TRUE,
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
    'db' => $db,
    'urlManager' => [
      'enablePrettyUrl' => TRUE,
//      'baseUrl' => 'banki.shop',
      'showScriptName' => FALSE,
      'rules' => [
        ['class' => 'yii\rest\UrlRule', 'controller' => 'images'],
        'site/<action:\w+>' => 'site/<action>',
      ],
    ],
  ],
  'params' => $params,
];

if (YII_ENV_DEV) {
  // configuration adjustments for 'dev' environment
  $config['bootstrap'][] = 'debug';
  $config['modules']['debug'] = [
    'class' => 'yii\debug\Module',
    // uncomment the following to add your IP if you are not connecting from localhost.
    //'allowedIPs' => ['127.0.0.1', '::1'],
  ];

  $config['bootstrap'][] = 'gii';
  $config['modules']['gii'] = [
    'class' => 'yii\gii\Module',
    // uncomment the following to add your IP if you are not connecting from localhost.
    //'allowedIPs' => ['127.0.0.1', '::1'],
  ];
}

return $config;

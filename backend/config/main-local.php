<?php

use yii\debug\Module;
use yii\gii\Module as ModuleAlias;

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dMlzDtwJxr56FH-T-d_LgeS4MlJ9YBvW',
        ],
    ],
];

// configuration adjustments for 'dev' environment
$config['bootstrap'][] = 'debug';
$config['modules']['debug'] = [
    'class' => Module::class,
];

$config['bootstrap'][] = 'gii';
$config['modules']['gii'] = [
    'class' => ModuleAlias::class,
    'allowedIPs' => ['*'],
];

return $config;

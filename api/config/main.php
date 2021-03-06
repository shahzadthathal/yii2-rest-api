<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            //'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ],
        'v2' => [
            //'basePath' => '@app/modules/v2',
            'class' => 'api\modules\v2\Module',
        ],
    ],
    'components' => [        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => ['v1/country', 'v1/post'],
                            'tokens' => ['{id}' => '<id:\\w+>']],
                ['class' => 'yii\rest\UrlRule', 'controller'=> ['v2/country', 'v2/post']]

            ],        
        ]
    ],
    'params' => $params,
];




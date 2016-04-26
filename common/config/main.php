<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',

    'modules' => [
        'auth' => [
            'class' => 'common\modules\auth\Module',
        ],
    ],

    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'memCache'=>[
        	'class'=> 'yii\caching\MemCache',
        ],

        'authManager' => [
    		'class' => 'yii\rbac\DbManager',
		], 

    ],
];

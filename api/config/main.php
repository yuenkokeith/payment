<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
   // 'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [
		'request' => [
			'parsers' => [
				'application/json' => 'yii\web\JsonParser',
			]
		],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            //'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
		
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-api',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
							'enablePrettyUrl' => true,
							'enableStrictParsing' => false,
							'showScriptName' => false,
							'rules' => [
										[
											'class' => 'yii\rest\UrlRule',
											'controller' => 'v1/auth',
											'extraPatterns' => [
												'GET index' => 'index',
												'POST login' => 'login',
												'POST accesstoken' => 'accesstoken',
												'POST get-user-profile' =>'get-user-profile'
											],
										],
							],
							/*
							[
								'class' => 'yii\rest\UrlRule',
								'controller' => 'v1/auth',
								'pluralize' => false,
								'extraPatterns' => [
									'GET index' => 'index'
								],
							],
							*/
							/*
							'class'  => 'yii\rest\UrlRule',
							'rules' => [
								'class'  => 'yii\rest\UrlRule',
								'controller'  => 'v1/auth',
								'extraPatterns' => [
												'GET,HEAD index' => 'index',
												'GET,HEAD {id}' => 'view'
											],
							],
							*/

					],
		
    ],
    'params' => $params,
];
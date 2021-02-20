<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\Json;
use yii\base\Response;
use yii\helpers\ArrayHelper;

/**
 * Test Controller API

 */
class TestController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Test';    

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => 'yii\filters\ContentNegotiator',
                //'only' => ['view', 'index'],  // in a controller
                // if in a module, use the following IDs for user actions
                // 'only' => ['user/view', 'user/index']
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ]);
    }

    public function actions() {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['index']);
        return $actions;
    }

    protected function verbs() {
        // set allowed methods for an action
        return [
            'index'=> ['GET','POST'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH','POST'],
            'delete' => ['DELETE'],
            
           // 'driver-car' => ['GET','POST'],
        ];
    }
    
    public function actionLogin() {
        //$userReslut = User::findByUsername('admin');

        //echo $userReslut['username'];
        //print_r(Yii::$app->request->get());
        //echo "<br/><br/><br/>";
        //print_r(Yii::$app->request->post());

        echo Json::encode([
                        'key' => '1',
                        'value' => 'Index: ' . 1
                    ]);
        
    }
}



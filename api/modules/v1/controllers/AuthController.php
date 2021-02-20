<?php

namespace api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\helpers\Json;
use yii\base\Response;
use yii\helpers\ArrayHelper;
use common\models\User;

/**
 * Auth Controller API
 * @2019-5-17 by keith Sin
 */
class AuthController extends ActiveController
{
    public $modelClass = 'common\models\User';  

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
            'view' => ['GET'],
            'login' => ['POST'],
            'accesstoken' => ['POST'],
        ];
    }
    
    public function actionIndex() {
		
       echo Json::encode([
                        'key' => '1',
                        'value' => 'Index: '
                ]);
    }

    public function actionLogin() {
    	
		$clientData = Yii::$app->request->post();
		$user = User::findByUsername(trim($clientData['username']));

		// return json data
		$data = null;
		$status = 0;
		$access_token = '';
		$msg = '';

		// check password
		if(isset($user)) {
			
			//check expired token(4 hours) and if empty
			if(empty($user->access_token)) {
				// generate new token
				$user->access_token = Yii::$app->security->generatePasswordHash(hash('sha512', Yii::$app->security->generateRandomString(), true));
				
				// generate 4 hours+ expire token date
				
			}

			if($user->validatePassword(trim($clientData['password']))) {
				$data = array(
								'id' => $user['id'],
								'username'=>$user['username']
							);

				$status = 1;
				$access_token = $user['access_token'];
				$msg = "login successful";

				// update last login datetime
				$user->save();
			} else {
				$msg = "password not correct";
			}

		} else {
			$msg = "username not found";
		}
		
		echo Json::encode([
			'data' => $data, 
			'status' => $status,
			'access_token' => $access_token,
			'msg' => $msg
		]);

    }

	// operation function requires token access
	public function actionGetUserProfile() {
		
		$clientData = Yii::$app->request->post();
	    $user = User::findIdentityByAccessToken($clientData['access_token']);

	   // return json data
		$data = null;
		$status = 0;
		$access_token = '';
		$msg = '';

		// Correct token and find user
		if(isset($user)) {
			$data = $user;
			$status = 1;
			$access_token = $user['access_token'];
			$msg = "function executed successfully";
		} else {
			$msg = "Token is not correct, require login again to get a new token";
		}

        echo Json::encode([
			'data' => $data, 
			'status' => $status,
			'access_token' => $access_token,
			'msg' => $msg
		]);		
        
    }

}



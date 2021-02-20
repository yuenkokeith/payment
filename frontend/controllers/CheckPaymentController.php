<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\ProductAnalysis;
use common\models\ReceiptProduct;
use yii\helpers\Json;

/**
 * CheckPayment controller
 */
class CheckPaymentController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSubmit() {
        
		$form = Yii::$app->request->post('form');
        $result = JSON::decode(Yii::$app->redis->get($form['keyword']));

		if($result!="" && !empty($result)) {
        
            return JSON::encode(array (
                                        array('status'=> '1', 'msg'=> 'Record is found', 'data' => $result)
                                       )
                                ); 
		} else {
            return JSON::encode(array (
                                        array('status'=> '0', 'msg'=> "Record No Found")
                                       )
                                ); 
		}

    }

}

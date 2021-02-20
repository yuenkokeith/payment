<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

/**
 * Country Controller API

 */
class CountryController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Country';    

    public function actionIndex()
    {
        echo "Country";
        exit;
    }
    
    public function actionLogin() {
        echo 'login';
        exit;
    }
}



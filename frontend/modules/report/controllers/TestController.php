<?php

namespace frontend\modules\report\controllers;

use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
   
}

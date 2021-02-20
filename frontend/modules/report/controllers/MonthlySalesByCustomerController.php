<?php

namespace frontend\modules\report\controllers;

use yii\web\Controller;

class MonthlySalesByCustomerController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
   
}

<?php

namespace frontend\modules\system\controllers;

use yii\web\Controller;

class SettingsController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
   
}

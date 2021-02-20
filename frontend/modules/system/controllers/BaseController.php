<?php

namespace frontend\modules\system\controllers;

use yii\web\Controller;

class BaseController extends Controller
{
    public $accessMode;

    /*
    yii::$app->controller->module->id
    Yii::$app->controller->id;
    Yii::$app->controller->action->id
    */

    public function saveToDb($model) {
        if($model->validate()) {
            $model->updated_at = time();
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if($model->save()) {
                    $transaction->commit();
                    return true;
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                return false;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                return false;
            }
        } else {
            return false;
        }
    }
}

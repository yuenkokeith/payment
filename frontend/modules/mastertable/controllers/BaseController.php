<?php

namespace frontend\modules\mastertable\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public $accessMode;

    /*
    yii::$app->controller->module->id
    Yii::$app->controller->id
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

    public function getModelName() {
        $controllerIdArr = explode("-",Yii::$app->controller->id);
        $modelName='';
        foreach($controllerIdArr as $idParts) {
            $modelName = $modelName. ucfirst($idParts);
        }
        return $modelName;
    }
}

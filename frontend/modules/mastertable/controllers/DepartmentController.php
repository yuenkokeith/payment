<?php

namespace frontend\modules\mastertable\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class DepartmentController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
   
   /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelClass = "\\frontend\modules\mastertable\models\\" . $this->getModelName() . "Search";
        $searchModel = new $modelClass();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model=$this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($this->saveToDb($model)) {
                Yii::$app->session->setFlash('kv-detail-success', 'Saved record successfully');
                return $this->redirect([
                                            'view', 
                                            'id'=>$model->id,
                                    ]);
            } else {
                Yii::$app->session->setFlash('kv-detail-warning', 'Record not updated!');
                return $this->redirect([
                                            'view', 
                                            'id'=>$model->id,
                                    ]);
            }
        } else {
            return $this->render('view', [
                                        'model'=>$model,
                                        ]
                                );
        }
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelClass = "\\frontend\modules\mastertable\models\\" . $this->getModelName();
        $model = new $modelClass();
       
        if ($model->load(Yii::$app->request->post())) {
            $model->created_at = time();
            if($this->saveToDb($model)) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $modelClass = "\\frontend\modules\mastertable\models\\" .  $this->getModelName();
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}

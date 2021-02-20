<?php

use yii\helpers\Html;
/* use yii\widgets\DetailView; */
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use common\models\Vendor;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->context->layout = 'viewLayout';

$this->registerJsFile(
    '@web/js/' . yii::$app->controller->module->id .'/' . Yii::$app->controller->id .'/view.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
    '@web/css/' . yii::$app->controller->module->id .'/' . Yii::$app->controller->id .'/view.css',[
    'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    'rel' => 'stylesheet',
], 'css-print-theme');

\yii\web\YiiAsset::register($this);

?>
<div class="book-view">

    <?php
        // setup your attributes
        $attributes=[
            [
                'attribute'=>'name',
                'format'=>'raw',
                'value'=>'<kbd>'.$model->name.'</kbd>',
                'displayOnly' => true
            ],
            [
                'attribute'=>'address',
                'format'=>'raw',
                'value'=>'address',
            ],
            [
                'attribute'=>'phone',
                'format'=>'raw',
                'value'=>'phone',
            ],
            [
                'attribute'=>'email',
                'format'=>'raw',
                'value'=>'email',
            ]
        ];

        echo DetailView::widget([
            'model'=>$model,
            'attributes'=>$attributes,
            'buttons2' => '{save} {delete}', 
            'deleteOptions'=>[ // your ajax delete parameters
                'params' => ['id' => $model->id, 'custom_param' => true],
            ],
            'bordered' => true,
            'striped' => false,
            'condensed' => false,
            'responsive' => true,
            'hover' => true,
            'mode' => 'edit',
            'fadeDelay'=> 1000,
            'container' => ['id'=>'kv-demo'],
            'panel' => [
                'type' => 'Primary',
                'heading' => 'Vendor Detail'
            ],
        ]);

    ?>

</div>

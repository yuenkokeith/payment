<?php

use yii\helpers\Html;
/* use yii\widgets\DetailView; */
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use common\models\Country;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->context->layout = 'viewLayout';

\yii\web\YiiAsset::register($this);

?>

<div class="book-view">

    <?php
        // setup your attributes
        $attributes=[
            [
                'attribute'=>'code',
                'format'=>'raw',
                'value'=>'<kbd>'.$model->code.'</kbd>',
                'displayOnly'=>true
            ],
            [
                'attribute'=>'name',
                'format'=>'raw',
                'value'=>'<kbd>'.$model->name.'</kbd>',
                'displayOnly'=>true
            ],
            [
                'attribute'=>'population',
                'label'=>'Population',
                'inputWidth'=>'40%'
            ],
            [
                'attribute'=>'status', 
                'label'=>'Available?',
                'format'=>'raw',
                'value'=>$model->status ? 
                    '<span class="label label-success">Yes</span>' : 
                    '<span class="label label-danger">No</span>',
                'type'=>DetailView::INPUT_SWITCH,
                'widgetOptions'=>[
                    'pluginOptions'=>[
                        'onText'=>'Yes',
                        'offText'=>'No',
                    ]
                ]
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
                'heading' => 'Country Detail'
            ],
        ]);

    ?>

    

</div>

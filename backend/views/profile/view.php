<?php

use yii\helpers\Html;
/* use yii\widgets\DetailView; */
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use common\models\User;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Book */

\yii\web\YiiAsset::register($this);

?>

<div class="book-view">

    <?php
        // setup your attributes
        $attributes=[
            [
                'attribute'=>'username',
                'format'=>'raw',
                'value'=>'<kbd>'.$model->username.'</kbd>',
                'displayOnly'=>true
            ],
            [
                'attribute'=>'password',
                'label'=>'Password',
                'format'=>'raw',
                'type'=>DetailView::INPUT_PASSWORD,
                'inputWidth'=>'40%'
            ],
            [
                'attribute'=>'email',
                'label'=>'Email',
                'format'=>'raw',
                'inputWidth'=>'40%'
            ],
            [
                'attribute'=>'created_at', 
                'format'=>'date',
                'displayOnly'=>true,
                'inputWidth'=>'40%'
            ],
            [
                'attribute'=>'status', 
                'label'=>'Available?',
                'format'=>'raw',
                'value'=> $model->status ? 
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
                'heading' => 'Profile'
            ],
        ]);

    ?>

    

</div>

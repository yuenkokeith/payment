<?php

use yii\helpers\Html;
/* use yii\widgets\DetailView; */
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use common\models\Book;
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
                'attribute'=>'book_code',
                'format'=>'raw',
                'value'=>'<kbd>'.$model->book_code.'</kbd>',
                'displayOnly'=>true
            ],
            /*
            'attribute'=>'book_name',
            [
                'attribute'=>'color',
                'format'=>'raw',
                'value'=>Html::tag('span', ' ', [
                    'class'=>'badge',
                    'style'=>'background-color' . $model->color,
                ]) . '<code>' . $model->color . '</code>',
                'type'=>DetailView::INPUT_COLOR,
                'inputWidth'=>'40%'
            ],
            */
            [
                'attribute'=>'publish_date', 
                'format'=>'date',
                'type'=>DetailView::INPUT_DATE,
                'widgetOptions'=>[
                    'pluginOptions'=>['format'=>'yyyy-mm-dd']
                ],
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
            ],
            [
                'attribute'=>'sale_amount',
                'label'=>'Sale Amount ($)',
                //'format'=>'double',
                'inputWidth'=>'40%'
            ],
            [
                'attribute'=>'buy_amount',
                'label'=>'Buy Amount ($)',
                //'format'=>'double',
                'inputWidth'=>'40%'
            ],
            /*
            [
                'attribute'=>'author_id',
                'format'=>'raw',
                'value'=>Html::a('John Steinbeck', '#', [
                    'class'=>'kv-author-link'
                ]),
                'type'=>DetailView::INPUT_SELECT2,
                'widgetOptions'=>[
                    'data'=>ArrayHelper::map(
                        Author::find()->orderBy('name')->asArray()->all(), 
                        'id', 
                        'name'
                    ),
                    'options'=>['placeholder'=>'Select ...'],
                    'pluginOptions'=>['allowClear'=>true]
                ],
                'inputWidth'=>'40%'
            ],
            */
            [
                'attribute'=>'synopsis',
                'format'=>'raw',
                'value'=>'<span class="text-justify"><em>' . $model->synopsis . 
                        '</em></span>',
                'type'=>DetailView::INPUT_TEXTAREA, 
                'options'=>['rows'=>4]
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
                'heading' => 'Book Detail'
            ],
        ]);

    ?>

    

</div>

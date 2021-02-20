<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Item;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
    '@web/web/js/item/index.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'value' => function ($model, $key, $index, $widget) { 
                    return $model->name;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Item::find()->orderBy('id')->asArray()->all(), 'id', 'name'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'vAlign'=>'middle',
                'filterInputOptions' => ['placeholder' => 'Any Item'],
                'group' => true,  // enable grouping
            ],
            [
                'attribute' => 'description',
                'value' => function ($model, $key, $index, $widget) { 
                    return $model->description;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Item::find()->orderBy('id')->asArray()->all(), 'id', 'description'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'vAlign'=>'middle',
                'filterInputOptions' => ['placeholder' => 'Any Description'],
                'group' => true,  // enable grouping
            ],
            [
                'class'=>'kartik\grid\DataColumn',
                'attribute'=>'price',
                'vAlign'=>'middle',
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status', 
                'vAlign'=>'middle',
            ],
            [
                'class' => 'kartik\grid\DataColumn',
                'header' => 'Edit',
                'vAlign'=>'middle',
                'hAlign'=> 'center',
                'content' => function ($model, $key, $index, $column) {
                    if($_SERVER['REQUEST_URI']==Yii::$app->params['requestPath'] . '/item') {
                        $refreshLink = "item/index?" . $_SERVER['QUERY_STRING'];
                    } else {
                        $refreshLink = "index?" . $_SERVER['QUERY_STRING'];
                    }
                    
                    ob_start(); //start a new buffer to convert as string
                        Modal::begin([
                            'header' => 'Detail View',
                            'size' => Modal::SIZE_LARGE,
                            'toggleButton' => ['label' => 'Edit', 'class' => 'btn btn-primary'],
                            'options' => ['tabindex' => false],
                            'clientOptions' => ['backdrop'=>'static'],
                            'closeButton' => ['id'=> 'closeBtn', 'onclick'=>'window.location.assign("' . $refreshLink .'")' ]
                        ]);
                    
                            echo '<iframe style="width:100%; height: 700px" src="' . Yii::$app->params['viewPageBaseUrl'] . '/item/view?id=' . $model->id . '"></iframe>';
                            
                        Modal::end();
                    return ob_get_clean();
                },
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template'=>'{delete}',
                'header' => 'Delete',
                'vAlign'=>'middle',
                'urlCreator' => function($action, $model, $key, $index) {
                    switch($action) {
                        case 'delete':
                            return 'delete?id=' . $key; 
                        break;
                    }
                },
            ],
        ];
        
    ?>

<?php
    // Create Button Modal
    $refreshLink = "index?" . $_SERVER['QUERY_STRING'];
    if($_SERVER['REQUEST_URI']==Yii::$app->params['requestPath'] . '/item') {
        $refreshLink = "item/index?" . $_SERVER['QUERY_STRING'];
    } else {
        $refreshLink = "index?" . $_SERVER['QUERY_STRING'];
    }
    ob_start(); //start a new buffer to convert as string
        Modal::begin([
            'header' => 'Create Record',
            'size' => Modal::SIZE_LARGE,
            'toggleButton' => ['label' => '<i class="glyphicon glyphicon-plus"></i>Add', 'class' => 'btn btn-success'],
            'options' => ['tabindex' => false],
            'clientOptions' => ['backdrop'=>'static'],
            'closeButton' => ['id'=> 'closeBtn', 'onclick'=>'window.location.assign("' . $refreshLink .'")' ]
        ]);
    
        echo '<iframe style="width:100%; height: 700px" src="' . Yii::$app->params['viewPageBaseUrl'] . '/item/create' . '"></iframe>';
    
        Modal::end();
    $createRecordBtn = ob_get_clean();
?>

<?php
    
    $refreshLink = "index?" . $_SERVER['QUERY_STRING'];
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        
        //'rowOptions' => function ($model, $key, $index, $grid) {
        //   return [
        //        'style' => "cursor: pointer",
        //        'editurl' => [ 'url'=> 'index?id=' , 'id'=> $model->id],
        //    ];
        // },
        
        'columns' => $gridColumns,
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'toolbar' =>  [
            ['content'=>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Item', 'class'=>'btn btn-success', 'onclick'=>'window.location.assign("' . Yii::$app->params['requestPath'] . '/item/create")']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', [$refreshLink], ['data-pjax'=>0, 'id' => 'refreshBtn', 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
            ],
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => true,
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]);
    
?>
  
</div>

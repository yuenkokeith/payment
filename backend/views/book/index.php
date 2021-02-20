<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Book;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
    '@web/web/js/book/index.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
        
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'book_code',
                'value' => function ($model, $key, $index, $widget) { 
                    return $model->book_code;
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Book::find()->orderBy('id')->asArray()->all(), 'id', 'book_code'), 
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'vAlign'=>'middle',
                'filterInputOptions' => ['placeholder' => 'Any Book'],
                'group' => true,  // enable grouping
            ],
            [
                'attribute'=>'color',
                'value'=>function ($model, $key, $index, $widget) {
                    return "<span class='badge' style='background-color: {$model->color}'> </span>  <code>" . 
                        $model->color . '</code>';
                },
                'filterType'=>GridView::FILTER_COLOR,
                'vAlign'=>'middle',
                'format'=>'raw',
                'width'=>'150px',
                'noWrap'=>true
            ],
            [
                'class'=>'kartik\grid\DataColumn',
                'attribute'=>'publish_date',
                'vAlign'=>'middle',
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['format'=>'yyyy-mm-dd']
                ]
            ],
            [
                'class'=>'kartik\grid\DataColumn',
                'attribute'=>'sale_amount',
                'vAlign'=>'middle',
            ],
            [
                'class'=>'kartik\grid\DataColumn',
                'attribute'=>'buy_amount', 
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
                    if($_SERVER['REQUEST_URI']==Yii::$app->params['requestPath'] . '/book') {
                        $refreshLink = "book/index?" . $_SERVER['QUERY_STRING'];
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
                    
                            echo '<iframe style="width:100%; height: 700px" src="' . Yii::$app->params['viewPageBaseUrl'] . '/book/view?id=' . $model->id . '"></iframe>';
                            
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
    if($_SERVER['REQUEST_URI']==Yii::$app->params['requestPath'] . '/book') {
        $refreshLink = "book/index?" . $_SERVER['QUERY_STRING'];
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
    
        echo '<iframe style="width:100%; height: 700px" src="' . Yii::$app->params['viewPageBaseUrl'] . '/book/create' . '"></iframe>';
    
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
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>'Add Book', 'class'=>'btn btn-success', 'onclick'=>'window.location.assign("' . Yii::$app->params['requestPath'] . '/book/create")']) . ' '.
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

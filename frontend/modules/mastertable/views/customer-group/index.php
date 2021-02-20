<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use frontend\modules\mastertable\models\CustomerGroup;
use yii\bootstrap\Modal;
use kartik\touchspin\TouchSpin;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CustomerGroup';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    '@web/js/' . yii::$app->controller->module->id .'/' . Yii::$app->controller->id .'/index.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<div class="book-index">

    <?php
    
        $gridColumns = [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class'=>'kartik\grid\DataColumn',
                'attribute'=>'name',
                'value' => 'name',
                'vAlign'=>'middle',
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'discount', 
                'readonly' => function($model, $key, $index, $widget) {
                    return (!$model->status); // do not allow editing of inactive records
                },
                'editableOptions' => [
                    'header' => 'Discount', 
                    'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                    'options' => [
                        'pluginOptions' => ['min' => 0, 'max' => 100]
                    ]
                ],
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'description', 
                'readonly' => function($model, $key, $index, $widget) {
                    return (!$model->status); // do not allow editing of inactive records
                },
                'editableOptions' => [
                    'header' => 'description', 
                    'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                   
                ],
                'hAlign' => 'right', 
                'vAlign' => 'middle',
                'width' => '7%',
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'status', 
                'vAlign'=>'middle',
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template'=>'{update}',
                'header' => 'Edit',
                'vAlign'=>'middle',
                'buttons'=>[
                        'update' => function($url,$model,$key){
                            $btn =  Html::button('<i class="glyphicon glyphicon-pencil"></i> Edit', ['type'=>'button', 'data-toggle'=>'modal', 'data-target'=>'#searchViewModal', 'data-backdrop'=>'static', 'title'=>'Search Vendor', 'class'=>'btn btn-success', 'onclick'=>'getViewAction("' . $model->id . '","mastertable/' . Yii::$app->controller->id . '","' . Yii::$app->params['viewPageBaseUrl'] . '")']);
                           
                            return $btn;
                        },
                ],
            ],
        ];
    ?>


<?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'toolbar' =>  [
            
            ['content'=>
                Html::button('<i class="glyphicon glyphicon-plus"></i> Add', ['type'=>'button', 'data-toggle'=>'modal', 'data-target'=>'#searchViewModal', 'data-backdrop'=>'static', 'title'=>'Add Vendor', 'class'=>'btn btn-success', 'onclick'=>'getCreateAction("/mastertable/' . Yii::$app->controller->id . '"' . ',' . '" ' . Yii::$app->params['viewPageBaseUrl'] . '")']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', [yii::$app->controller->module->id .'/' . Yii::$app->controller->id], ['data-pjax'=>0, 'id' => 'refreshBtn', 'class' => 'btn btn-default', 'title'=>'Reset Grid'])
            ],
            
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => true,
        'responsive' => false,
        'responsiveWrap' => false,
        'hover' => true,
        'floatHeader' => true,
        'floatHeaderOptions' => [
            'position' => 'absolute'
        ],
        'toggleDataContainer' => ['class' => 'btn-group mr-2'],
        'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]);
?>

</div>

<!-- Search Modal -->
<div class="modal fade" id="searchViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="float:left">Detail View</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:closeModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="searchViewContent" class="modal-body">
      </div>
    </div>
  </div>
    <?php
        \yii\web\YiiAsset::register($this);
    ?>
</div>




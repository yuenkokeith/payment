<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;
use common\models\Customer;
use common\models\Country;
use common\models\Order;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->context->layout = 'viewLayout';

$this->registerJsFile(
    '@web/web/js/order/view.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

\yii\web\YiiAsset::register($this);

?>

<div class="book-view">

    <?php

        $countryModel = Country::findOne($model->customer[0]['country_id']);

        // setup your attributes
        $attributes=[
            [
                'attribute'=>'order_no',
                'format'=>'raw',
                'value'=>'<kbd>'.$model->order_no.'</kbd>',
                'displayOnly'=>true
            ],
            [
                'attribute'=>'order_date',
                'type'=>DetailView::INPUT_TEXT, 
                'label'=>'Order Date',
                'format'=>'raw',
                'inputWidth'=>'40%',
                'displayOnly' => true
            ],
            [
                'group'=>true,
                'label'=>'Customer Information',
                'rowOptions'=>['class'=>'table-info']
            ],
            [
                'label'=>'Customer',
                'type'=>DetailView::INPUT_TEXT, 
                'value'=>'<span id="showCustomRaw"></span>'.$model->customer[0]['username'].'',
                'format'=>'raw',
                'inputWidth'=>'40%'
            ],
            [
                'label'=>'Email',
                'type'=>DetailView::INPUT_TEXT,
                'value'=>'<span id="showCustomRaw"></span>'.$model->customer[0]['email'].'',
                'format'=>'raw',
                'inputWidth'=>'40%'
            ],
            [
                'label'=>'Country',
                'type'=>DetailView::INPUT_TEXT, 
                'value'=> '<span id="showCustomRaw">' . $countryModel->name,
                'format'=>'raw',
                'inputWidth'=>'40%'
            ],
            [
                'group'=>true,
                'label'=>'Item Detail',
                'rowOptions'=>['class'=>'table-info']
            ],
            [
                'label'=>'Item',
                'format'=>'raw',
                'value'=>'<span class="text-justify">Name: <em>' . $model->items[0]['name'] . '</em></span><br/>
                            <span class="text-justify">Desc: <em>' . $model->items[0]['description'] . '</em></span><br/>
                            <span class="text-justify">Qty: <em>' . $model->orderItems[0]['qty'] . '</em></span><br/>
                            <span class="text-justify">Price: <em>' . $model->items[0]['price'] . '</em></span>
                        ',
                'type'=>DetailView::INPUT_TEXTAREA, 
                'options'=>['rows'=>4],
                'displayOnly' => 'true'
            ],
            [
                'label'=>'Item',
                'format'=>'raw',
                'value'=>'<span class="text-justify">Name: <em>' . $model->items[0]['name'] . '</em></span><br/>
                            <span class="text-justify">Desc: <em>' . $model->items[0]['description'] . '</em></span><br/>
                            <span class="text-justify">Qty: <em>' . $model->orderItems[0]['qty'] . '</em></span><br/>
                            <span class="text-justify">Price: <em>' . $model->items[0]['price'] . '</em></span>
                        ',
                'type'=>DetailView::INPUT_TEXTAREA, 
                'options'=>['rows'=>4],
                'displayOnly' => 'true'
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
                'heading' => 'Order Detail'
            ],
        ]);

    ?>

    

</div>

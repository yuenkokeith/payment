<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Book;
use common\models\Author;
use yii\bootstrap\Modal;
use frontend\modules\system\models\SakilaRental;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monthly Sales By Customer';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    '@web/js/report/monthly-sales-by-customer/index.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<div class="book-index">

    <?php
        $report = new SakilaRental;
        $report->run()->render();
    ?>

</div>



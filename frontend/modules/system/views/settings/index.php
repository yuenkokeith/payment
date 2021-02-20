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

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    '@web/js/system/settings/index.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<div class="book-index">

    <?php
        $report = new SakilaRental;
        $report->run()->render();
    ?>

</div>



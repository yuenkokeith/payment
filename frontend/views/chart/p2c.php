<?php

/* @var $this yii\web\View */

$this->title = 'Data Chart System';

use scotthuangzl\googlechart\GoogleChart;
use bsadnu\googlecharts\ColumnChart;
use bsadnu\googlecharts\BarChart;
use bsadnu\googlecharts\Histogram;
use bsadnu\googlecharts\ComboChart;
use bsadnu\googlecharts\LineChart;
use bsadnu\googlecharts\AreaChart;
use bsadnu\googlecharts\SteppedAreaChart;
use bsadnu\googlecharts\PieChart;
use bsadnu\googlecharts\Sankey;
use bsadnu\googlecharts\GeoChart;
use bsadnu\googlecharts\BubbleChart;
use bsadnu\googlecharts\ScatterChart;

$brand = 'BULGARI';

if(isset($_GET['brand'])) {
    $brand = $brand;
} 

?>
<div class="site-index">

    <div class="body-content" id="app">

        <div class="row">

            <div class="col-lg-4 col-sm-5">

                <select name="brand" id="brand" onchange="changeBrand()">
                  <option value="BULGARI" <?php if($brand=='BULGARI') { ?> selected <?php }  ?> >BULGARI</option>
                  <option value="HOGAN" <?php if($brand=='HOGAN') { ?> selected <?php }  ?> >HOGAN</option>
                  <option value="LONGINES" <?php if($brand=='LONGINES') { ?> selected <?php }  ?> >LONGINES</option>
                  <option value="VERSACE" <?php if($brand=='VERSACE') { ?> selected <?php }  ?> >VERSACE</option>
                  <option value="YSL" <?php if($brand=='YSL') { ?> selected <?php }  ?>>YSL</option>
                </select> 

                 <?php
                    echo Yii::$app->controller->renderPartial('_p2cChart', [
                        'totalSpending' => $totalSpending,
                        'pieChartData'=>$pieChartData
                    ]);
                ?>

            </div>

            <div class="col-lg-4 col-sm-5">
                  
            </div>

            <div class="col-lg-4 col-sm-5">
               
            </div>
        </div>


        <!-- another extension -->
        <div class="row">

            <div class="col-lg-4 col-sm-5">
               
            </div>

            <div class="col-lg-4 col-sm-5">

            </div>

            <div class="col-lg-4 col-sm-5">

                   
            </div>

        </div>

    </div>
</div>

<style>

	.tableBlock {
		height:400px; 
		max-height:400px;
		
	}

</style>

<script>

    function changeBrand(value) {
        console.log(location.hostname);
        console.log(window.location.href);

        window.location.href = location.protocol+'//'+ location.hostname + "/datachart/chart/p2c?brand=" + $( "#brand option:selected" ).text();
        //window.location.href = "http://localhost/datachart/chart/p2c?brand=" + $( "#brand option:selected" ).text();
    }

</script>
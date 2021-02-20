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

?>


<?php
					
	$allTotal = 0;
	foreach($totalSpending as $total) {
		$allTotal = $allTotal + $total['total'];
	}

                    
    echo GoogleChart::widget(array('visualization' => 'PieChart',
    'data' => $pieChartData,
    'options' => array('title' => 'Total Spending Amount: $' . $allTotal)));
					
?>

<style>

	.tableBlock {
		height:400px; 
		max-height:400px;
		
	}

</style>



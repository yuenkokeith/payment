<?php

use scotthuangzl\googlechart\GoogleChart;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <?php
		
            echo GoogleChart::widget( array('visualization' => 'Gauge', 'packages' => 'gauge',
                'data' => array(
                    array('Label', 'Value'),
                    array('Memory', 80),
                    array('CPU', 55),
                    array('Network', 68),
                ),
                'options' => array(
                    'width' => 400,
                    'height' => 120,
                    'redFrom' => 90,
                    'redTo' => 100,
                    'yellowFrom' => 75,
                    'yellowTo' => 90,
                    'minorTicks' => 5
                )
            ));
		
        ?>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
            <?php
				
                echo GoogleChart::widget(array('visualization' => 'PieChart',
                    'data' => array(
                        array('Task', 'Hours per Day'),
                        array('Work', 11),
                        array('Eat', 2),
                        array('Commute', 2),
                        array('Watch TV', 2),
                        array('Sleep', 7)
                    ),
                    'options' => array('title' => 'My Daily Activity')));
				
                ?>
            </div>
            <div class="col-lg-4">
               <?php
					
                    echo GoogleChart::widget(array('visualization' => 'LineChart',
                    'data' => array(
                        array('Task', 'Hours per Day'),
                        array('Work', 11),
                        array('Eat', 2),
                        array('Commute', 2),
                        array('Watch TV', 2),
                        array('Sleep', 7)
                    ),
                    'options' => array('title' => 'My Daily Activity')));
					
               ?>
            </div>
            <div class="col-lg-4">
                <?php
					
                    echo GoogleChart::widget(array('visualization' => 'LineChart',
                    'data' => array(
                        array('Year', 'Sales', 'Expenses'),
                        array('2004', 1000, 400),
                        array('2005', 1170, 460),
                        array('2006', 660, 1120),
                        array('2007', 1030, 540),
                    ),
                    'options' => array(
                        'title' => 'My Company Performance2',
                        'titleTextStyle' => array('color' => '#FF0000'),
                        'vAxis' => array(
                            'title' => 'Scott vAxis',
                            'gridlines' => array(
                                'color' => 'transparent'  //set grid line transparent
                            )),
                        'hAxis' => array('title' => 'Scott hAixs'),
                        'curveType' => 'function', //smooth curve or not
                        'legend' => array('position' => 'bottom'),
                    )));
					
                ?>
            </div>
        </div>

    </div>
</div>

<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

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
<div class="site-index">

    <div class="jumbotron">
        
    </div>

    <div class="body-content">


		<div class="row">

            <div class="col-lg-12 col-sm-12">

                <!-- vuejs components -->
				<div id="userListDynmaicInput">
				  <div>
						<b-button
							 aria-controls="collapse-4"
							 @click="userList"
						>
						 Select Product List
						</b-button>
				
						<!-- Dynamic Input -->
						  <div v-for="input in inputs" :key="input.id">
							<b-container>
							  <b-row cols="8" cols-sm="8" cols-md="8" cols-lg="8">
								<b-col>
									<label>Name</label>
									<input placeholder="Enter your name" v-model="input.name" key="name-input">
								</b-col>
								<b-col>
									<label>Model</label>
									<input placeholder="Enter your model" v-model="input.model" key="model-input">
								</b-col>
								<b-col>
									<label>qty</label>
									<input placeholder="Enter your qty" v-model="input.qty" key="qty-input">
								</b-col>
								<b-col>
									<label>list price</label>
									<input placeholder="Enter your list price" v-model="input.lprice" key="lprice-input">
								</b-col>
								<b-col>
									<label>unit price</label>
									<input placeholder="Enter your unit price" v-model="input.uprice" key="uprice-input">
								</b-col>
								<b-col>
									<label>Amount</label>
									<input v-model="sumAmount(input)" key="amount-input">
								</b-col>
								<b-col>
									<label>Action</label>
									<br/>
									<b-button aria-controls="collapse-4" @click="removeUser(input)">Remove</b-button>
								</b-col>
							  </b-row>
							</b-container>

						  </div>
						 {{ inputs }}
		 
						<!-- Product list modal -->
						<b-modal class="modal zoomIn" size="600" ref="userlist-modal">
							<b-table
								class="disableHightLight"
								selectable 
								select-mode="single" 
								striped hover 
								:items="userlist"
								@row-selected="onRowSelected"
								@row-dblclicked="rowDbClicked"
							>
							</b-table>
							{{ selectedUser }}

							<template v-slot:modal-footer class="zoomInDown">
								<div class="w-100">
									<p class="float-left">Modal Footer</p>
									<b-button
									variant="primary"
									size="sm"
									class="float-right"
									@click="closeModal"
									>
									Close
									</b-button>
									<b-button
									variant="primary"
									size="sm"
									class="float-right"
									@click="addUser"
									>
									Ok
									</b-button>
								</div>
							</template>
						</b-modal>
				  </div>
				</div>


				<br/><br/><br/><br/>

				<div id="dynmaicInput">
				  <div>
						<b-button
						  aria-controls="collapse-4"
						  @click="addInput"
						>
						 add input
						</b-button>
				
						  <div v-for="input in inputs" :key="input.id">
							<label>Username</label>
								<input placeholder="Enter your username" v-model="input.username" key="username-input">
							<label>password</label>
								<input placeholder="Enter your password" v-model="input.password" key="password-input">
							<label>qty</label>
								<input placeholder="Enter your qty" v-model="input.qty" key="qty-input">
							<label>list price</label>
								<input placeholder="Enter your list price" v-model="input.lprice" key="lprice-input">
							<label>unit price</label>
								<input placeholder="Enter your unit price" v-model="input.uprice" key="uprice-input">
							<label>Amount</label>
								<input v-model="sumAmount(input)" key="amount-input">
						
						  </div>
						 {{ inputs }}
				  </div>

				</div>





				<div id="app">
					<div>
						<!-- :fields="fields" -->
						<!--  striped hover -->
						<!--  show-empty -->
						<b-table striped 
								show-empty
								:fields="fields"
								:items="filtered">
					
							<template slot="top-row" slot-scfieldope="{ fields }" v-for="field in fields">
								<td v-if="field.label!='Age' && field.label!='Full Name' && field.label!='Group' && field.label!='Actions' 
											&& field.label!='Gender'  && field.label!='Last Name'
											&& field.label!='Is Active' && field.label!='First Name'
											" 
									:key="field.key">
								  <input class="form-control form-control-md" v-model="filtersFields[field.key]" :placeholder="field.label">
								</td>


								<!-- alternative filter box -->
								<td v-else-if="field.label==='Age'" :key="field.key">
									<!--
									<b-form-select 
										v-model="filtersFields[field.key]" 
										style="width:150px"
										:options="firstnamefiltered" 
										class="form-control form-control-lg"
									>
									</b-form-select>
									-->
									<v-select 
										v-model="filtersFields[field.key]" 
										:options="agefiltered" 
										placeholder="...Find Age"
									 />
								</td>

								<!-- alternative filter box -->
								<td v-else-if="field.label==='Full Name'" :key="field.key">
								</td>

								<!-- alternative filter box -->
								<td v-else-if="field.label==='First Name'" :key="field.key">
									<!--
									<b-form-select 
										v-model="filtersFields[field.key]" 
										style="width:150px"
										:options="firstnamefiltered" 
										class="form-control form-control-lg"
									>
									</b-form-select>
									-->
									<v-select 
										v-model="filtersFields[field.key]" 
										:options="firstnamefiltered" 
										placeholder="...Find First Name "
									 />
								</td>

								<!-- alternative filter box -->
								<td v-else-if="field.label==='Last Name'" :key="field.key">
									<v-select 
										v-model="filtersFields[field.key]" 
										:options="lastnamefiltered" 
										placeholder="...Find Last Name "
									 />
								</td>
						
								<!-- alternative filter box -->
								<td v-else-if="field.label==='Group'" :key="field.key">
									<!--
									<b-form-select 
										v-model="filtersFields[field.key]" 
										:options="options" 
										style="width:150px"
										class="form-control form-control-lg"
									/>
									-->

									<v-select 
										v-model="filtersFields[field.key]" 
										:options="groupfiltered" 
										placeholder="...Find Group "
									 />
								</td>

								<!-- alternative filter box -->
								<td v-else-if="field.label==='Gender'" :key="field.key">
									<!--
									<b-form-select 
										v-model="filtersFields[field.key]" 
										:options="genderOptions" 
										style="width:150px"
										class="form-control form-control-lg"
									/>
									-->
									<v-select 
										v-model="filtersFields[field.key]" 
										:options="genderfiltered" 
										placeholder="...Find Gender "
									 />
								</td>

								<!-- alternative filter box -->
								<td v-else-if="field.label==='Is Active'" :key="field.key">
									<b-form-checkbox
										v-model="filtersFields[field.key]"
										value="1"
										unchecked-value="0"
									/>
								</td>

								<!-- skip filter box -->
								<td v-else-if="field.label==='Actions'" :key="field.key">
									<!--
									<date-picker v-model="date" :config="{format: 'DD-MM-YYYY'}"></date-picker>
									-->
								</td>

							</template>
					

							<template v-slot:cell(name)="data">
								<b class="text-info">{{ data.value.last }}</b>, <b>{{ data.value.first }}</b>
							</template>

							<!--
							<template v-slot:cell(age)="data">
								<b-form-input
									type="text"
									v-model="data.item.age"
									style="width:150px"
								/>
							</template>

							<template v-slot:cell(first_name)="data">
								<b-form-input
									type="text"
									v-model="data.item.first_name"
									style="width:150px"
								/>
							</template>

							<template v-slot:cell(last_name)="data">
								<b-form-input
									type="text"
									v-model="data.item.last_name"
									style="width:150px"
								/>
							</template>
							-->



							<template v-slot:cell(group)="data">
								<b-form-select 
									v-model="data.item.group" 
									:options="options" 
									style="width:150px"
								/>
							</template>

							<template v-slot:cell(gender)="data">
								<b-form-select 
									v-model="data.item.gender" 
									:options="genderOptions" 
									style="width:150px"
								/>
							</template>
					
							<template v-slot:cell(is_active)="data">
								<b-form-checkbox
									v-model="data.item.is_active"
									value="1"
									unchecked-value="0"
								/>
							</template>	
					
							<template v-slot:cell(actions)="row">
								<b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
									Edit modal
								</b-button>
								<b-button size="sm" @click="iframeinfo(row.item, row.index, $event.target)" class="mr-1">
									Show modal(iframe)
								</b-button>
								<b-button size="sm" @click="row.toggleDetails">
									{{ row.detailsShowing ? 'Hide' : 'Show' }} Details
								</b-button>
							</template>

							<template v-slot:row-details="row">
								<b-card class="fadeIn">
									<ul>
									<li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
									</ul>

									<b-row class="mb-2">
									<b-col sm="3" class="text-sm-right"><b>Age:</b></b-col>
									<b-form-input
										type="text"
										v-model="row.item.age"
										style="width:150px"
										/>
									</b-row>

									<b-row class="mb-2">
									<b-col sm="3" class="text-sm-right"><b>First Name:</b></b-col>
									<b-form-input
										type="text"
										v-model="row.item.first_name"
										style="width:150px"
										/>
									</b-row>

									<b-row class="mb-2">
									<b-col sm="3" class="text-sm-right"><b>Last Name:</b></b-col>
									<b-form-input
										type="text"
										v-model="row.item.last_name"
										style="width:150px"
										/>
									</b-row>

									<b-row class="mb-2">
									<b-col sm="3" class="text-sm-right"><b>Last Name:</b></b-col>
									<b-form-input
										type="text"
										v-model="row.item.last_name"
										style="width:150px"
										/>
									</b-row>
						  
									<b-row class="mb-2">
									<b-col sm="3" class="text-sm-right"><b>Group:</b></b-col>
									<b-form-select 
										v-model="row.item.group" 
										:options="options" 
										style="width:150px"
									/>
									</b-row>

									<b-row class="mb-2">
									<b-col sm="3" class="text-sm-right"><b>Gender:</b></b-col>
									<b-form-select 
										v-model="row.item.gender" 
										:options="genderOptions" 
										style="width:150px"
									/>
									</b-row>

									<b-row class="mb-2">
									<b-col sm="3" class="text-sm-right"><b>Is Active:</b></b-col>
									<b-form-checkbox
										id="checkbox-1"
										v-model="row.item.is_active"
										name="checkbox-1"
										value="1"
										unchecked-value="0"
									/>
									</b-row>

								</b-card>
							</template>
					
						</b-table>
						{{ items }}
					</div>
			

					 <!-- Info modal -->
						<b-modal ref="my-modal" :id="infoModal.id" :title="infoModal.title" class="fadeIn">
							<pre>{{ infoModal.content }}</pre>
				
							<b-row class="mb-2">
								<b-col sm="3" class="text-sm-right"><b>Age:</b></b-col>
								<b-form-input
									type="text"
									v-model="infoModal.content.age"
									style="width:150px"
									/>
							</b-row>

							<b-row class="mb-2">
								<b-col sm="3" class="text-sm-right"><b>First Name:</b></b-col>
								<b-form-input
									type="text"
									v-model="infoModal.content.first_name"
									style="width:150px"
									/>
							</b-row>

							<b-row class="mb-2">
								<b-col sm="3" class="text-sm-right"><b>Last Name:</b></b-col>
								<b-form-input
									type="text"
									v-model="infoModal.content.last_name"
									style="width:150px"
									/>
							</b-row>

							<b-row class="mb-2">
								<b-col sm="3" class="text-sm-right"><b>Group:</b></b-col>
								<b-form-select 
									v-model="infoModal.content.group" 
									:options="options" 
									style="width:150px"
								/>
							</b-row>

							<b-row class="mb-2">
								<b-col sm="3" class="text-sm-right"><b>Gender:</b></b-col>
								<b-form-select 
									v-model="infoModal.content.gender" 
									:options="genderOptions" 
									style="width:150px"
								/>
							</b-row>

							<b-row class="mb-2">
								<b-col sm="3" class="text-sm-right"><b>Is Active:</b></b-col>
								<b-form-checkbox
									  id="checkbox-1"
									  v-model="infoModal.content.is_active"
									  name="checkbox-1"
									  value="1"
									  unchecked-value="0"
								/>
							</b-row>
					
							<template v-slot:modal-footer>
							<div class="w-100">
							  <p class="float-left">Modal Footer Content</p>
							  <b-button
								variant="primary"
								size="sm"
								class="float-right"
								@click="closeModal"
							  >
								Close
							  </b-button>
							  <b-button
								variant="primary"
								size="sm"
								class="float-right"
								@click="okInfoModal"
							  >
								Ok
							  </b-button>
							</div>
						  </template>
						</b-modal>
			 

						<!-- Iframe Info modal -->
						<b-modal class="modal zoomIn" size="1200" ref="my-iframemodal" :id="iframeinfoModal.id" :title="iframeinfoModal.title">
							<div id="detailContent" style="height:100%" class="zoomInDown"></div>

							<template v-slot:modal-footer class="zoomInDown">
								<div class="w-100">
									<p class="float-left">Modal Footer</p>
									<b-button
									variant="primary"
									size="sm"
									class="float-right"
									@click="closeIframeModal"
									>
									Close
									</b-button>
									<b-button
									variant="primary"
									size="sm"
									class="float-right"
									@click="okIframeInfoModal"
									>
									Ok
									</b-button>
								</div>
							</template>
						</b-modal>
				</div>
				<!-- vuejs components -->




			</div>

		</div>

        <div class="row">

            <div class="col-lg-4 col-sm-5">

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

            <div class="col-lg-4 col-sm-5">

                <?php
                     echo GoogleChart::widget(array('visualization' => 'ScatterChart',
                    'data' => array(
                        array('Sales', 'Expenses', 'Quarter'),
                        array(1000, 400, '2015 Q1'),
                        array(1170, 460, '2015 Q2'),
                        array(660, 1120, '2015 Q3'),
                        array(1030, 540, '2015 Q4'),
                    ),
                    'scriptAfterArrayToDataTable' => "data.setColumnProperty(2, 'role', 'tooltip');",
                    'options' => array(
                        'title' => 'Expenses vs Sales',
                    )));


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

                    echo GoogleChart::widget( array('visualization' => 'Map',
                    'packages'=>'map',//default is corechart
                    'loadVersion'=>1,//default is 1.  As for Calendar, you need change to 1.1
                    'data' => array(
                        ['Country', 'Population'],
                        ['China', 'China: 1,363,800,000'],
                        ['India', 'India: 1,242,620,000'],
                        ['US', 'US: 317,842,000'],
                        ['Indonesia', 'Indonesia: 247,424,598'],
                        ['Brazil', 'Brazil: 201,032,714'],
                        ['Pakistan', 'Pakistan: 186,134,000'],
                        ['Nigeria', 'Nigeria: 173,615,000'],
                        ['Bangladesh', 'Bangladesh: 152,518,015'],
                        ['Russia', 'Russia: 146,019,512'],
                        ['Japan', 'Japan: 127,120,000']
                    ),
                    'options' => array('title' => 'My Daily Activity',
                        'showTip'=>true,
                    )));
                ?>
               
            </div>

            <div class="col-lg-4 col-sm-5">
               
            </div>
        </div>


        <!-- another extension -->
        <div class="row">

            <div class="col-lg-4 col-sm-5">
                <?= ColumnChart::widget([
	                    'id' => 'my-column-chart-id',
                        'data' => [
                            ['Year', 'Sales', 'Expenses'],
                            ['2013',  1000,      400],
                            ['2014',  1170,      460],
                            ['2015',  660,       1120],
                            ['2016',  1030,      540]
                        ],
                        'options' => [
                            'fontName' => 'Verdana',
                            'height' => 400,
                            'fontSize' => 12,
                            'chartArea' => [
        	                    'left' => '5%',
        	                    'width' => '90%',
        	                    'height' => 350
                            ],
                            'tooltip' => [
        	                    'textStyle' => [
        		                    'fontName' => 'Verdana',
        		                    'fontSize' => 13
        	                    ]
                            ],
                            'vAxis' => [
        	                    'title' => 'Sales and Expenses',
        	                    'titleTextStyle' => [
        		                    'fontSize' => 13,
        		                    'italic' => false
        	                    ],
        	                    'gridlines' => [
        		                    'color' => '#e5e5e5',
        		                    'count' => 10
        	                    ],            	
        	                    'minValue' => 0
                            ],
                            'legend' => [
        	                    'position' => 'top',
        	                    'alignment' => 'center',
        	                    'textStyle' => [
        		                    'fontSize' => 12
        	                    ]
                            ]            
                        ]
                    ])
                    ?>

                    <br/>

                    <?= ColumnChart::widget([
	                    'id' => 'my-stacked-column-chart-id',
                        'data' => [
		                    ['Genre', 'Fantasy & Sci Fi', 'Romance', 'Mystery/Crime', 'General', 'Western', 'Literature'],
		                    ['2000', 20, 30, 35, 40, 45, 30],
		                    ['2005', 14, 20, 25, 30, 48, 30],
		                    ['2010', 10, 24, 20, 32, 18, 5],
		                    ['2015', 15, 25, 30, 35, 20, 15],
		                    ['2020', 16, 22, 23, 30, 16, 9],
		                    ['2025', 12, 26, 20, 40, 20, 30],
		                    ['2030', 28, 19, 29, 30, 12, 13]
                        ],
                        'options' => [
                            'fontName' => 'Verdana',
                            'height' => 400,
                            'fontSize' => 12,
                            'chartArea' => [
        	                    'left' => '5%',
        	                    'width' => '90%',
        	                    'height' => 350
                            ],
                            'isStacked' => true,
                            'tooltip' => [
        	                    'textStyle' => [
        		                    'fontName' => 'Verdana',
        		                    'fontSize' => 13
        	                    ]
                            ],
                            'vAxis' => [
        	                    'title' => 'Sales and Expenses',
        	                    'titleTextStyle' => [
        		                    'fontSize' => 13,
        		                    'italic' => false
        	                    ],
        	                    'gridlines' => [
        		                    'color' => '#e5e5e5',
        		                    'count' => 10
        	                    ],            	
        	                    'minValue' => 0
                            ],
                            'legend' => [
        	                    'position' => 'top',
        	                    'alignment' => 'center',
        	                    'textStyle' => [
        		                    'fontSize' => 12
        	                    ]
                            ]            
                        ]
                    ]) ?>

                    <br/>

                    <?= ColumnChart::widget([
                        'id' => 'my-column-trendlines-chart-id',
                        'data' => [
                            ['Week', 'Bugs', 'Tests'],
                            [1, 175, 10],
                            [2, 159, 20],
                            [3, 126, 35],
                            [4, 129, 40],
                            [5, 108, 60],
                            [6, 92, 70],
                            [7, 55, 72],
                            [8, 50, 97]
                        ],
                        'options' => [
                            'fontName' => 'Verdana',
                            'height' => 450,
                            'curveType' => 'function',
                            'fontSize' => 12,
                            'chartArea' => [
                                'left' => 50,
                                'width' => '92%',
                                'height' => 350
                            ],
                            'hAxis' => [
                                'format' => '#',
                                'viewWindow' => [
                                    'min' => 0,
                                    'max' => 9
                                ],            
                                'gridlines' => [
                                    'count' => 10
                                ]
                            ],   
                            'vAxis' => [
                                'title' => 'Bugs and tests',
                                'titleTextStyle' => [
                                    'fontSize' => 13,
                                    'italic' => false
                                ],            
                                'gridlines' => [
                                    'color' => '#e5e5e5',
                                    'count' => 10
                                ],
                                'minValue' => 0
                            ],
                            'colors' => [
                                '#6D4C41',
                                '#FB8C00'
                            ],
                            'trendlines' => [
                                0 => [
                                    'labelInLegend' => 'Bug line',
                                    'visibleInLegend' => true
                                ],            
                                1 => [
                                    'labelInLegend' => 'Test line',
                                    'visibleInLegend' => true
                                ]
                            ],             
                            'legend' => [
                                'position' => 'top',
                                'alignment' => 'end',
                                'textStyle' => [
                                    'fontSize' => 12
                                ]
                            ]
                        ]
                    ]) ?>

                    <br/>

                    <?= AreaChart::widget([
	                    'id' => 'my-staked-area-chart-id',
	                    'data' => [
		                    ['Year', 'Cars', 'Trucks', 'Drones', 'Segways'],
		                    ['2013',  870,  460, 310, 220],
		                    ['2014',  460,  720, 220, 460],
		                    ['2015',  930,  640, 340, 330],
		                    ['2016',  1000,  400, 180, 500]
	                    ],
	                    'options' => [
		                    'fontName' => 'Verdana',
		                    'height' => 400,
		                    'curveType' => 'function',
		                    'fontSize' => 12,
		                    'areaOpacity' => 0.4,
		                    'chartArea' => [
			                    'left' => '5%',
			                    'width' => '90%',
			                    'height' => 350
		                    ],
		                    'isStacked' => true,
		                    'pointSize' => 4,
		                    'tooltip' => [
			                    'textStyle' => [
				                    'fontName' => 'Verdana',
				                    'fontSize' => 13
			                    ]
		                    ],
		                    'lineWidth' => 1.5,
		                    'vAxis' => [
			                    'title' => 'Number values',
			                    'titleTextStyle' => [
				                    'fontSize' => 13,
				                    'italic' => false
			                    ],        	
			                    'gridlines' => [
				                    'color' => '#e5e5e5',
				                    'count' => 10
			                    ],            	
			                    'minValue' => 0
		                    ],        
		                    'legend' => [
			                    'position' => 'top',
			                    'alignment' => 'end',
			                    'textStyle' => [
				                    'fontSize' => 12
			                    ]
		                    ]            
	                    ]
                    ]) ?>


                     <br/>


                     <?= SteppedAreaChart::widget([
	                    'id' => 'my-stepped-area-chart-id',
	                    'data' => [
		                    ['Director (Year)',  'Rotten Tomatoes', 'IMDB'],
		                    ['Alfred Hitchcock (1935)', 8.4,         7.9],
		                    ['Ralph Thomas (1959)',     6.9,         6.5],
		                    ['Don Sharp (1978)',        6.5,         6.4],
		                    ['James Hawes (2008)',      4.4,         6.2]
	                    ],
	                    'options' => [
		                    'fontName' => 'Verdana',
		                    'height' => 400,
		                    'isStacked' => true,
		                    'fontSize' => 12,
		                    'chartArea' => [
			                    'left' => '5%',
			                    'width' => '90%',
			                    'height' => 350
		                    ],
		                    'lineWidth' => 1,
		                    'tooltip' => [
			                    'textStyle' => [
				                    'fontName' => 'Verdana',
				                    'fontSize' => 13
			                    ]
		                    ],
		                    'pointSize' => 5,	
		                    'vAxis' => [
			                    'title' => 'Accumulated Rating',
			                    'titleTextStyle' => [
				                    'fontSize' => 13,
				                    'italic' => false
			                    ],        	
			                    'gridlines' => [
				                    'color' => '#e5e5e5',
				                    'count' => 10
			                    ],            	
			                    'minValue' => 0
		                    ],        
		                    'legend' => [
			                    'position' => 'top',
			                    'alignment' => 'center',
			                    'textStyle' => [
				                    'fontSize' => 12
			                    ]
		                    ]            
	                    ]
                    ]) ?>


                    <br/>


                    <?= PieChart::widget([
                        'id' => 'my-pie-chart-id',
                        'data' => [
                            ['Major', 'Degrees'],
                            ['Business', 256070],
                            ['Education', 108034],
                            ['Social Sciences & History', 127101],
                            ['Health', 81863],
                            ['Psychology', 74194]
                        ],
                        'extraData' => [
                            ['Major', 'Degrees'],
                            ['Business', 358293],
                            ['Education', 101265],
                            ['Social Sciences & History', 172780],
                            ['Health', 129634],
                            ['Psychology', 97216]
                        ],                
                        'options' => [
                            'fontName' => 'Verdana',
                            'height' => 300,
                            'width' => 500,
                            'chartArea' => [
                                'left' => 50,
                                'width' => '90%',
                                'height' => '90%'
                            ],
                            'diff' => [
                                'extraData' => [
                                    'inCenter' => false
                                ]
                            ]
                        ]
                    ]) ?>


                    <br/>

                    <?= Sankey::widget([
                    'id' => 'my-sankey-diagram-id',
                    'data' => [
                        [ 'Brazil', 'Portugal', 4 ],
                        [ 'Brazil', 'France', 1 ],
                        [ 'Brazil', 'Spain', 1 ],
                        [ 'Brazil', 'England', 1 ],
                        [ 'Canada', 'Portugal', 1 ],
                        [ 'Canada', 'France', 4 ],
                        [ 'Canada', 'England', 1 ],
                        [ 'Mexico', 'Portugal', 1 ],
                        [ 'Mexico', 'France', 1 ],
                        [ 'Mexico', 'Spain', 4 ],
                        [ 'Mexico', 'England', 1 ],
                        [ 'USA', 'Portugal', 1 ],
                        [ 'USA', 'France', 1 ],
                        [ 'USA', 'Spain', 1 ],
                        [ 'USA', 'England', 4 ],
                        [ 'Portugal', 'Angola', 2 ],
                        [ 'Portugal', 'Senegal', 1 ],
                        [ 'Portugal', 'Morocco', 1 ],
                        [ 'Portugal', 'South Africa', 3 ],
                        [ 'France', 'Angola', 1 ],
                        [ 'France', 'Mali', 3 ],
                        [ 'France', 'Morocco', 3 ],
                        [ 'France', 'South Africa', 1 ],
                        [ 'Spain', 'Senegal', 1 ],
                        [ 'Spain', 'Morocco', 3 ],
                        [ 'Spain', 'South Africa', 1 ],
                        [ 'England', 'Angola', 1 ],
                        [ 'England', 'Senegal', 1 ],
                        [ 'England', 'Morocco', 2 ],
                        [ 'England', 'South Africa', 4 ],
                        [ 'South Africa', 'India', 1 ],
                        [ 'South Africa', 'Japan', 3 ],
                        [ 'Angola', 'China', 2 ],
                        [ 'Angola', 'India', 1 ],
                        [ 'Angola', 'Japan', 3 ],
                        [ 'Senegal', 'China', 2 ],
                        [ 'Senegal', 'India', 1 ],
                        [ 'Senegal', 'Japan', 3 ],
                        [ 'Mali', 'China', 2 ],
                        [ 'Mali', 'India', 1 ],
                        [ 'Mali', 'Japan', 3 ],
                        [ 'Morocco', 'China', 2 ],
                        [ 'Morocco', 'India', 1 ],
                        [ 'Morocco', 'Japan', 3 ],
                        [ 'Morocco', 'Senegal', 1 ]
                    ],
                    'options' => [
                        'height' => 400,
                        'sankey' => [
                            'link' => [
                                'color' => [
                                    'fill' => '#eee',
                                    'fillOpacity' => 0.3
                                ]
                            ],
                            'node' => [
                                'width' => 8,
                                'nodePadding' => 80,
                                'label' => [
                                    'fontName' => 'Verdana',
                                    'fontSize' => 13
                                ]
                            ]
                        ]
                    ]
                ]) ?>

                <br/>

                <?= GeoChart::widget([
                    'id' => 'my-regions-geo-chart-id',
                    'data' => [
                        ['Country', 'Popularity'],
                        ['Germany', 200],
                        ['United States', 300],
                        ['Brazil', 400],
                        ['Canada', 500],
                        ['France', 600],
                        ['RU', 700]
                    ],
                    'options' => [
                        'fontName' => 'Verdana',
                        'height' => 500,
                        'width' => '100%',
                        'fontSize' => 12,
                        'tooltip' => [
                            'textStyle' => [
                                'fontName' => 'Verdana',
                                'fontSize' => 13
                            ]
                        ]              
                    ]

                ]) ?>

                 <br/>

                 <?= BubbleChart::widget([
                    'id' => 'my-simple-bubble-chart-id',
                    'data' => [
                        ['ID', 'Life Expectancy', 'Fertility Rate', 'Region'],
                        ['CAN',    82.66,              1.67,      'North America'],
                        ['DEU',    79.84,              1.36,      'Europe'],
                        ['DNK',    70.6,               1.84,      'Europe'],
                        ['EGY',    72.73,              2.78,      'Middle East'],
                        ['GBR',    75.05,              2,         'Europe'],
                        ['IRN',    72.49,              0.7,       'Middle East'],
                        ['IRQ',    68.09,              4.77,      'Middle East'],
                        ['ISR',    81.55,              3.96,      'Middle East'],
                        ['RUS',    68.6,               1.54,      'Europe'],
                        ['USA',    78.09,              3.05,      'North America']
                    ],
                    'options' => [
                        'fontName' => 'Verdana',
                        'height' => 450,
                        'fontSize' => 12,
                        'chartArea' => [
                            'left' => 50,
                            'width' => '90%',
                            'height' => 400
                        ],
                        'tooltip' => [
                            'textStyle' => [
                                'fontName' => 'Verdana',
                                'fontSize' => 13
                            ]
                        ],
                        'vAxis' => [
                            'title' => 'Fertility Rate',
                            'titleTextStyle' => [
                                'fontSize' => 13,
                                'italic' => false
                            ],
                            'gridlines' => [
                                'color' => '#e5e5e5',
                                'count' => 10
                            ],
                            'minValue' => 0
                        ],
                        'bubble' => [
                            'textStyle' => [
                                'auraColor' => 'none',
                                'color' => '#fff'
                            ],
                            'stroke' => '#fff'
                        ],
                        'legend' => [
                            'position' => 'top',
                            'alignment' => 'center',
                            'textStyle' => [
                                'fontSize' => 12
                            ]
                        ]
                    ]
                ]) ?>


                <br/>


                <?= BubbleChart::widget([
                    'id' => 'my-colnumb-bubble-chart-id',
                    'data' => [
                        ['ID', 'X', 'Y', 'Temperature'],
                        ['',   80,  167,      120],
                        ['',   79,  136,      130],
                        ['',   78,  184,      50],
                        ['',   72,  278,      230],
                        ['',   81,  200,      210],
                        ['',   72,  170,      100],
                        ['',   68,  477,      80]
                    ],
                    'options' => [
                        'fontName' => 'Verdana',
                        'height' => 450,
                        'fontSize' => 12,
                        'chartArea' => [
                            'left' => 50,
                            'width' => '90%',
                            'height' => 400
                        ],
                        'tooltip' => [
                            'textStyle' => [
                                'fontName' => 'Verdana',
                                'fontSize' => 13
                            ]
                        ],
                        'vAxis' => [
                            'gridlines' => [
                                'color' => '#e5e5e5',
                                'count' => 10
                            ],
                            'minValue' => 0
                        ],
                        'bubble' => [
                            'textStyle' => [
                                'fontSize' => 11
                            ],
                            'stroke' => '#fff'
                        ]
                    ]
                ]) ?>



            </div>

            <div class="col-lg-4 col-sm-5">

                <?= ColumnChart::widget([
                    'id' => 'my-column-diff-chart-id',
                    'data' => [
                        ['Name', 'Popularity'],
                        ['Cesar', 425],
                        ['Rachel', 420],
                        ['Patrick', 290],
                        ['Eric', 620],
                        ['Eugene', 520],
                        ['John', 460],
                        ['Greg', 420],
                        ['Matt', 410]
                    ],
                    'extraData' => [
                        ['Name', 'Popularity'],
                        ['Cesar', 307],
                        ['Rachel', 360],
                        ['Patrick', 200],
                        ['Eric', 550],
                        ['Eugene', 460],
                        ['John', 320],
                        ['Greg', 390],
                        ['Matt', 360]
                    ],
                    'options' => [
                        'fontName' => 'Verdana',
                        'height' => 400,
                        'fontSize' => 12,
                        'chartArea' => [
                            'left' => '5%',
                            'width' => '90%',
                            'height' => 350
                        ],
                        'colors' => [
                            '#4CAF50'
                        ],
                        'tooltip' => [
                            'textStyle' => [
                                'fontName' => 'Verdana',
                                'fontSize' => 13
                            ]
                        ],              
                        'hAxis' => [
                            'format' => '#',
                            'viewWindow' => [
                                'min' => 0,
                                'max' => 9
                            ],            
                            'gridlines' => [
                                'count' => 10
                            ]
                        ],   
                        'vAxis' => [
                            'title' => 'Popularity',
                            'titleTextStyle' => [
                                'fontSize' => 13,
                                'italic' => false
                            ],            
                            'gridlines' => [
                                'color' => '#e5e5e5',
                                'count' => 10
                            ],
                            'minValue' => 0
                        ],
                        'legend' => [
                            'position' => 'top',
                            'alignment' => 'end',
                            'textStyle' => [
                                'fontSize' => 12
                            ]
                        ]
                    ]
                ]) ?>

                <br/>

                <?= ColumnChart::widget([
                    'id' => 'my-column-diff-chart-id',
                    'data' => [
                        ['Name', 'Popularity'],
                        ['Cesar', 425],
                        ['Rachel', 420],
                        ['Patrick', 290],
                        ['Eric', 620],
                        ['Eugene', 520],
                        ['John', 460],
                        ['Greg', 420],
                        ['Matt', 410]
                    ],
                    'extraData' => [
                        ['Name', 'Popularity'],
                        ['Cesar', 307],
                        ['Rachel', 360],
                        ['Patrick', 200],
                        ['Eric', 550],
                        ['Eugene', 460],
                        ['John', 320],
                        ['Greg', 390],
                        ['Matt', 360]
                    ],
                    'options' => [
                        'fontName' => 'Verdana',
                        'height' => 400,
                        'fontSize' => 12,
                        'chartArea' => [
                            'left' => '5%',
                            'width' => '90%',
                            'height' => 350
                        ],
                        'colors' => [
                            '#4CAF50'
                        ],
                        'tooltip' => [
                            'textStyle' => [
                                'fontName' => 'Verdana',
                                'fontSize' => 13
                            ]
                        ],              
                        'hAxis' => [
                            'format' => '#',
                            'viewWindow' => [
                                'min' => 0,
                                'max' => 9
                            ],            
                            'gridlines' => [
                                'count' => 10
                            ]
                        ],   
                        'vAxis' => [
                            'title' => 'Popularity',
                            'titleTextStyle' => [
                                'fontSize' => 13,
                                'italic' => false
                            ],            
                            'gridlines' => [
                                'color' => '#e5e5e5',
                                'count' => 10
                            ],
                            'minValue' => 0
                        ],
                        'legend' => [
                            'position' => 'top',
                            'alignment' => 'end',
                            'textStyle' => [
                                'fontSize' => 12
                            ]
                        ]
                    ]
                ]) ?>

                <br/>


                <?= BarChart::widget([
	                'id' => 'my-bar-chart-id',
                    'data' => [
                        ['Year', 'Sales', 'Expenses'],
                        ['2004',  1000,      400],
                        ['2005',  1170,      460],
                        ['2006',  660,       1120],
                        ['2007',  1030,      540]
                    ],
                    'options' => [
                        'fontName' => 'Verdana',
                        'height' => 400,
                        'fontSize' => 12,
                        'chartArea' => [
        	                'left' => '5%',
        	                'width' => '90%',
        	                'height' => 350
                        ],
                        'tooltip' => [
        	                'textStyle' => [
        		                'fontName' => 'Verdana',
        		                'fontSize' => 13
        	                ]
                        ],
                        'vAxis' => [
        	                'gridlines' => [
        		                'color' => '#e5e5e5',
        		                'count' => 10
        	                ],            	
        	                'minValue' => 0
                        ],
                        'legend' => [
        	                'position' => 'top',
        	                'alignment' => 'center',
        	                'textStyle' => [
        		                'fontSize' => 12
        	                ]
                        ]            
                    ]
                ]) ?>

                   <br/>

                   <?= ScatterChart::widget([
                    'id' => 'my-scatter-simple-chart-id',
                    'data' => [
                        ['Age', 'Weight'],
                        [ 8,      12],
                        [ 4,      6],
                        [ 11,     14],
                        [ 4,      5],
                        [ 3,      3.5],
                        [ 6.5,    7],
                        [ 7,    10],
                        [ 6.5,    12],
                        [ 6,    13],
                        [ 8,    16],
                        [ 12,    17],
                        [ 18,    8],
                        [ 18,    9],
                        [ 16,    12]
                    ],
                    'options' => [
                        'fontName' => 'Verdana',
                        'height' => 450,
                        'fontSize' => 12,
                        'chartArea' => [
                            'left' => 50,
                            'width' => '90%',
                            'height' => 400
                        ],
                        'tooltip' => [
                            'textStyle' => [
                                'fontName' => 'Verdana',
                                'fontSize' => 13
                            ]
                        ],
                        'hAxis' => [
                            'minValue' => 0,
                            'maxValue' => 15
                        ],        
                        'vAxis' => [
                            'title' => 'Weight',
                            'titleTextStyle' => [
                                'fontSize' => 13,
                                'italic' => false
                            ],            
                            'gridlines' => [
                                'color' => '#e5e5e5',
                                'count' => 10
                            ],
                            'minValue' => 0,
                            'maxValue' => 15
                        ],
                        'legend' => 'none',
                        'pointSize' => 10,
                        'colors' => [
                            '#E53935'
                        ]
                    ]
                ]) ?>


                  <br/>


            <?= ScatterChart::widget([
                'id' => 'my-scatter-diff-chart-id',
                'data' => [
                    ['', 'Medicine 1', 'Medicine 2'],
                    [23, null, 12], [9, null, 39], [15, null, 28],
                    [37, null, 30], [21, null, 14], [12, null, 18],
                    [29, null, 34], [ 8, null, 12], [38, null, 28],
                    [35, null, 12], [26, null, 10], [10, null, 29],
                    [11, null, 10], [27, null, 38], [39, null, 17],
                    [34, null, 20], [38, null,  5], [33, null, 27],
                    [23, null, 39], [12, null, 10], [ 8, 15, null],
                    [39, 15, null], [27, 31, null], [30, 24, null],
                    [31, 39, null], [35,  6, null], [ 5,  5, null],
                    [19, 39, null], [22,  8, null], [19, 23, null],
                    [27, 20, null], [11,  6, null], [34, 33, null],
                    [38,  8, null], [39, 29, null], [13, 23, null],
                    [13, 36, null], [39,  6, null], [14, 37, null], [13, 39, null]
                ],
                'extraData' => [
                    ['', 'Medicine 1', 'Medicine 2'],
                    [22, null, 12], [7, null, 40], [14, null, 31],
                    [37, null, 30], [18, null, 17], [9, null, 20],
                    [26, null, 36], [5, null, 13], [36, null, 30],
                    [35, null, 15], [24, null, 12], [7, null, 31],
                    [10, null, 12], [24, null, 40], [37, null, 18],
                    [32, null, 21], [35, null, 7], [31, null, 30],
                    [21, null, 42], [12, null, 10], [10, 13, null],
                    [40, 12, null], [28, 29, null], [32, 22, null],
                    [31, 37, null], [38, 5, null], [6, 4, null],
                    [21, 36, null], [22, 8, null], [21, 22, null],
                    [28, 17, null], [12, 5, null], [37, 30, null],
                    [41, 7, null], [41, 27, null], [15, 20, null],
                    [14, 36, null], [42, 3, null], [14, 37, null], [15, 36, null]
                ],
                'options' => [
                    'fontName' => 'Verdana',
                    'height' => 450,
                    'fontSize' => 12,
                    'chartArea' => [
                        'left' => 50,
                        'width' => '90%',
                        'height' => 400
                    ],
                    'tooltip' => [
                        'textStyle' => [
                            'fontName' => 'Verdana',
                            'fontSize' => 13
                        ]
                    ],
                    'hAxis' => [
                        'minValue' => 0
                    ],        
                    'vAxis' => [
                        'gridlines' => [
                            'color' => '#e5e5e5',
                            'count' => 5
                        ],
                        'minValue' => 0
                    ],
                    'legend' => [
                        'position' => 'top',
                        'alignment' => 'center',
                        'textStyle' => [
                            'fontSize' => 12
                        ]
                    ],
                    'diff' => [
                        'oldData' => [
                            'opacity' => 0.5
                        ]
                    ]
                ]
            ]) ?>
            </div>

            <div class="col-lg-4 col-sm-5">


                <?= BarChart::widget([
	                'id' => 'my-stacked-bar-chart-id',
                    'data' => [
		                ['Genre', 'Fantasy & Sci Fi', 'Romance', 'Mystery/Crime', 'General', 'Western', 'Literature'],
		                ['2000', 20, 30, 35, 40, 45, 30],
		                ['2005', 14, 20, 25, 30, 48, 30],
		                ['2010', 10, 24, 20, 32, 18, 5],
		                ['2015', 15, 25, 30, 35, 20, 15],
		                ['2020', 16, 22, 23, 30, 16, 9],
		                ['2025', 12, 26, 20, 40, 20, 30],
		                ['2030', 28, 19, 29, 30, 12, 13]
                    ],
                    'options' => [
                        'fontName' => 'Verdana',
                        'height' => 400,
                        'fontSize' => 12,
                        'chartArea' => [
        	                'left' => '5%',
        	                'width' => '90%',
        	                'height' => 350
                        ],
                        'isStacked' => true,
                        'tooltip' => [
        	                'textStyle' => [
        		                'fontName' => 'Verdana',
        		                'fontSize' => 13
        	                ]
                        ],
                        'hAxis' => [
        	                'gridlines' => [
        		                'color' => '#e5e5e5',
        		                'count' => 10
        	                ],            	
        	                'minValue' => 0
                        ],
                        'legend' => [
        	                'position' => 'top',
        	                'alignment' => 'center',
        	                'textStyle' => [
        		                'fontSize' => 12
        	                ]
                        ]            
                    ]
                ]) ?>


                <br/>

                    <?= Histogram::widget([
	                'id' => 'my-simple-histogram-id',
	                'data' => [
		                ['Dinosaur', 'Length'],
		                ['Acrocanthosaurus (top-spined lizard)', 12.2],
		                ['Albertosaurus (Alberta lizard)', 9.1],
		                ['Allosaurus (other lizard)', 12.2],
		                ['Apatosaurus (deceptive lizard)', 22.9],
		                ['Archaeopteryx (ancient wing)', 0.9],
		                ['Argentinosaurus (Argentina lizard)', 36.6],
		                ['Baryonyx (heavy claws)', 9.1],
		                ['Brachiosaurus (arm lizard)', 30.5],
		                ['Ceratosaurus (horned lizard)', 6.1],
		                ['Coelophysis (hollow form)', 2.7],
		                ['Compsognathus (elegant jaw)', 0.9],
		                ['Deinonychus (terrible claw)', 2.7],
		                ['Diplodocus (double beam)', 27.1],
		                ['Dromicelomimus (emu mimic)', 3.4],
		                ['Gallimimus (fowl mimic)', 5.5],
		                ['Mamenchisaurus (Mamenchi lizard)', 21.0],
		                ['Megalosaurus (big lizard)', 7.9],
		                ['Microvenator (small hunter)', 1.2],
		                ['Ornithomimus (bird mimic)', 4.6],
		                ['Oviraptor (egg robber)', 1.5],
		                ['Plateosaurus (flat lizard)', 7.9],
		                ['Sauronithoides (narrow-clawed lizard)', 2.0],
		                ['Seismosaurus (tremor lizard)', 45.7],
		                ['Spinosaurus (spiny lizard)', 12.2],
		                ['Supersaurus (super lizard)', 30.5],
		                ['Tyrannosaurus (tyrant lizard)', 15.2],
		                ['Ultrasaurus (ultra lizard)', 30.5],
		                ['Velociraptor (swift robber)', 1.8]
	                ],
	                'options' => [
	                    'fontName' => 'Verdana',
	                    'height' => 400,
	                    'fontSize' => 12,
	                    'chartArea' => [
	    	                'left' => '5%',
	    	                'width' => '90%',
	    	                'height' => 350
	                    ],
	                    'isStacked' => true,
	                    'tooltip' => [
	    	                'textStyle' => [
	    		                'fontName' => 'Verdana',
	    		                'fontSize' => 13
	    	                ]
	                    ],
	                    'vAxis' => [
	    	                'title' => 'Dinosaur length',
	    	                'titleTextStyle' => [
	    		                'fontSize' => 13,
	    		                'italic' => false
	    	                ],        	
	    	                'gridlines' => [
	    		                'color' => '#e5e5e5',
	    		                'count' => 10
	    	                ],            	
	    	                'minValue' => 0
	                    ],        
	                    'hAxis' => [
	    	                'gridlines' => [
	    		                'color' => '#e5e5e5'
	    	                ],            	
	    	                'minValue' => 0
	                    ],
	                    'legend' => [
	    	                'position' => 'top',
	    	                'alignment' => 'center',
	    	                'textStyle' => [
	    		                'fontSize' => 12
	    	                ]
	                    ]            
	                ]
                ]) ?>
               

                <br/>


                    <?= ComboChart::widget([
	                'id' => 'my-combo-chart-id',
	                'data' => [
		                ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
		                ['2004/05',  165,      938,         522,             998,           450,      614.6],
		                ['2005/06',  135,      1120,        599,             1268,          288,      682],
		                ['2006/07',  157,      1167,        587,             807,           397,      623],
		                ['2007/08',  139,      1110,        615,             968,           215,      609.4],
		                ['2008/09',  136,      691,         629,             1026,          366,      569.6]
	                ],
	                'options' => [
	                    'fontName' => 'Verdana',
	                    'height' => 400,
	                    'fontSize' => 12,
	                    'chartArea' => [
	    	                'left' => '5%',
	    	                'width' => '90%',
	    	                'height' => 350
	                    ],
	                    'seriesType' => 'bars',
		                'series' => [
			                5 => [
				                'type' => 'line',
				                'pointSize' => 5
			                ]
		                ],        
	                    'tooltip' => [
	    	                'textStyle' => [
	    		                'fontName' => 'Verdana',
	    		                'fontSize' => 13
	    	                ]
	                    ],
	                    'vAxis' => [
	    	                'gridlines' => [
	    		                'color' => '#e5e5e5',
	    		                'count' => 10
	    	                ],            	
	    	                'minValue' => 0
	                    ],        
	                    'legend' => [
	    	                'position' => 'top',
	    	                'alignment' => 'center',
	    	                'textStyle' => [
	    		                'fontSize' => 12
	    	                ]
	                    ]            
	                ]
                ]) ?>


                <br/>



                    <?= LineChart::widget([
	                    'id' => 'my-simple-line-chart-id',
	                    'data' => [
		                    ['Year', 'Sales', 'Expenses'],
		                    ['2004',  1000,      400],
		                    ['2005',  1170,      460],
		                    ['2006',  660,       1120],
		                    ['2007',  1030,      540]
	                    ],
	                    'options' => [
	                        'fontName' => 'Verdana',
	                        'height' => 400,
	                        'curveType' => 'function',
	                        'fontSize' => 12,
	                        'chartArea' => [
	    	                    'left' => '5%',
	    	                    'width' => '90%',
	    	                    'height' => 350
	                        ],
	                        'pointSize' => 4,
	                        'tooltip' => [
	    	                    'textStyle' => [
	    		                    'fontName' => 'Verdana',
	    		                    'fontSize' => 13
	    	                    ]
	                        ],
	                        'vAxis' => [
	    	                    'title' => 'Sales and Expenses',
			                    'titleTextStyle' => [
				                    'fontSize' => 13,
				                    'italic' => false
			                    ],        	
	    	                    'gridlines' => [
	    		                    'color' => '#e5e5e5',
	    		                    'count' => 10
	    	                    ],            	
	    	                    'minValue' => 0
	                        ],        
	                        'legend' => [
	    	                    'position' => 'top',
	    	                    'alignment' => 'center',
	    	                    'textStyle' => [
	    		                    'fontSize' => 12
	    	                    ]
	                        ]            
	                    ]
                    ]) ?>


                    <br/>


                    <?= LineChart::widget([
	                    'id' => 'my-line-intervals-id',
	                    'isIntervalType' => true,
	                    'data' => [
		                    ['a', 100, 90, 110, 85, 96, 104, 120],
		                    ['b', 120, 95, 130, 90, 113, 124, 140],
		                    ['c', 130, 105, 140, 100, 117, 133, 139],
		                    ['d', 90, 85, 95, 85, 88, 92, 95],
		                    ['e', 70, 74, 63, 67, 69, 70, 72],
		                    ['f', 30, 39, 22, 21, 28, 34, 40],
		                    ['g', 80, 77, 83, 70, 77, 85, 90],
		                    ['h', 100, 90, 110, 85, 95, 102, 110]
	                    ],
	                    'options' => [
		                    'fontName' => 'Verdana',
		                    'height' => 400,
		                    'curveType' => 'function',
		                    'fontSize' => 12,
		                    'chartArea' => [
			                    'left' => '5%',
			                    'width' => '90%',
			                    'height' => 350
		                    ],
		                    'lineWidth' => 3,
		                    'tooltip' => [
			                    'textStyle' => [
				                    'fontName' => 'Verdana',
				                    'fontSize' => 13
			                    ]
		                    ],
		                    'series' => [
			                    [
				                    'color' => '#EF5350'
			                    ]
		                    ],
		                    'intervals' => [
			                    'style' => 'line'
		                    ],
		                    'pointSize' => 5,	
		                    'vAxis' => [
			                    'title' => 'Number values',
			                    'titleTextStyle' => [
				                    'fontSize' => 13,
				                    'italic' => false
			                    ],        	
			                    'gridlines' => [
				                    'color' => '#e5e5e5',
				                    'count' => 10
			                    ],            	
			                    'minValue' => 0
		                    ],        
		                    'legend' => 'none'            
	                    ]
                    ]) ?>


                    <br/>


                    <?= LineChart::widget([
	                    'id' => 'my-area-intervals-id',
	                    'isIntervalType' => true,
	                    'data' => [
		                    ['a', 100, 90, 110, 85, 96, 104, 120],
		                    ['b', 120, 95, 130, 90, 113, 124, 140],
		                    ['c', 130, 105, 140, 100, 117, 133, 139],
		                    ['d', 90, 85, 95, 85, 88, 92, 95],
		                    ['e', 70, 74, 63, 67, 69, 70, 72],
		                    ['f', 30, 39, 22, 21, 28, 34, 40],
		                    ['g', 80, 77, 83, 70, 77, 85, 90],
		                    ['h', 100, 90, 110, 85, 95, 102, 110]
	                    ],
	                    'options' => [
		                    'fontName' => 'Verdana',
		                    'height' => 400,
		                    'curveType' => 'function',
		                    'fontSize' => 12,
		                    'chartArea' => [
			                    'left' => '5%',
			                    'width' => '90%',
			                    'height' => 350
		                    ],
		                    'lineWidth' => 2,
		                    'tooltip' => [
			                    'textStyle' => [
				                    'fontName' => 'Verdana',
				                    'fontSize' => 13
			                    ]
		                    ],
		                    'series' => [
			                    [
				                    'color' => '#43A047'
			                    ]
		                    ],
		                    'intervals' => [
			                    'style' => 'area'
		                    ],
		                    'pointSize' => 5,	
		                    'vAxis' => [
			                    'title' => 'Number values',
			                    'titleTextStyle' => [
				                    'fontSize' => 13,
				                    'italic' => false
			                    ],        	
			                    'gridlines' => [
				                    'color' => '#e5e5e5',
				                    'count' => 10
			                    ],            	
			                    'minValue' => 0
		                    ],        
		                    'legend' => 'none'            
	                    ]
                    ]) ?>


                    <br/>

                    <?= AreaChart::widget([
	                    'id' => 'my-simple-area-chart-id',
                        'data' => [
		                    ['Year', 'Sales', 'Expenses'],
		                    ['2004',  1000,      400],
		                    ['2005',  1170,      460],
		                    ['2006',  660,       1120],
		                    ['2007',  1030,      540]
                        ],
                        'options' => [
                            'fontName' => 'Verdana',
                            'height' => 400,
                            'curveType' => 'function',
                            'fontSize' => 12,
                            'areaOpacity' => 0.4,
                            'chartArea' => [
        	                    'left' => '5%',
        	                    'width' => '90%',
        	                    'height' => 350
                            ],
                            'pointSize' => 4,
                            'tooltip' => [
        	                    'textStyle' => [
        		                    'fontName' => 'Verdana',
        		                    'fontSize' => 13
        	                    ]
                            ],
                            'vAxis' => [
        	                    'title' => 'Sales and Expenses',
			                    'titleTextStyle' => [
				                    'fontSize' => 13,
				                    'italic' => false
			                    ],        	
        	                    'gridarea' => [
        		                    'color' => '#e5e5e5',
        		                    'count' => 10
        	                    ],            	
        	                    'minValue' => 0
                            ],        
                            'legend' => [
        	                    'position' => 'top',
        	                    'alignment' => 'end',
        	                    'textStyle' => [
        		                    'fontSize' => 12
        	                    ]
                            ]            
                        ]
                    ]) ?>

            </div>

        </div>

    </div>
</div>

<script>

	new Vue({
		el: '#userListDynmaicInput',
		data() {
			return {
				id: 0,
				inputs: [],
				userlist: [
					{ name: 'XNX', model:'XNX-100', qty: '1', lprice: '8000', uprice:'7000' }, 
					{ name: 'GYN', model:'GYN100', qty: '1', lprice: '12000', uprice:'11500'}, 
					{ name: 'PY', model:'PY3000', qty: '1', lprice: '15000', uprice:'13500'},
					{ name: 'LG', model:'LG1205', qty: '1', lprice: '7500', uprice:'7000'},
					{ name: 'NA', model:'NA1200', qty: '1', lprice: '6000', uprice:'5800'},
					{ name: 'KT', model:'KT6022', qty: '1', lprice: '17000', uprice:'15500'},
					{ name: 'HY', model:'HY0001', qty: '1', lprice: '25000', uprice:'21500'}
				],
				selectedUser: []
			}
		},
		methods: {
			onRowSelected(items) {
				this.selectedUser = items
				//console.log(this.selectedUser)
				//console.log(this.selectedUser[0]['model'])
			},
			rowDbClicked() {
				this.addUser()
			},
			userList() {
				this.showModal()
			},
			addInput () {
			
				let isDuplicated = this.inputs.filter(c => {
					return c.model.indexOf(this.selectedUser[0].model) > -1
					}
				)
	  
				if(isDuplicated==0) {
					this.inputs.push({
						id: this.id,
						name: this.selectedUser[0].name,
						model: this.selectedUser[0].model,
						qty: this.selectedUser[0].qty,
						lprice: this.selectedUser[0].lprice,
						uprice: this.selectedUser[0].uprice
					});
					// increment the id for the next input that will be created.
					this.id++;
				} else {
					this.msgbox('cannot add duplicated product!')
				}
				
			},
			msgbox(msg) {
				this.$bvModal.msgBoxOk(msg, {
					  title: 'System Message',
					  size: 'sm',
					  buttonSize: 'sm',
					  okVariant: 'success',
					  headerClass: 'p-2 border-bottom-0',
					  footerClass: 'p-2 border-top-0',
					  centered: true
					})
					  .then(value => {
						//this.boxTwo = value
					  })
					  .catch(err => {
						// An error occurred
					  })
			},
			msgboxYesNo(msg, actionType='', obj=null) {
				this.$bvModal.msgBoxConfirm(msg, {
					  title: 'System Message',
					  size: 'sm',
					  buttonSize: 'sm',
					  okVariant: 'danger',
					  okTitle: 'YES',
					  cancelTitle: 'NO',
					  headerClass: 'p-2 border-bottom-0',
					  footerClass: 'p-2 border-top-0',
					  centered: true
					})
					  .then(value => {
						// confirmed
						if(value) {
							switch(actionType) {
								case 'remove':
									for( var i = 0; i < this.inputs.length; i++){ 
										if ( this.inputs[i].id === obj.id) {
											// match current input id and remove this input
											this.inputs.splice(i, 1)
										}
									}
								break;
								case 'insert':
								// code block
								break;
								default:
								// code block
							}
						}
					  })
					  .catch(err => {
						// An error occurred
					  })
			},
			sumAmount(input) {
				if(!isNaN(input.qty) && !isNaN(input.uprice)) {
					input.amount = input.qty * input.uprice
				} else {
					input.amount = ''
				}
				
				return input.amount
			},
			addUser() {
				if(this.selectedUser.length>0) {
					this.addInput()
					this.selectedUser = []
					this.closeModal()
				}
			},
			removeUser(input) {
				this.msgboxYesNo('are you sure to remove this product!', 'remove', input)
			},
			showModal() {
				this.$refs['userlist-modal'].show()
			},
			closeModal() {
				this.$refs['userlist-modal'].hide()
			}
		}
	})
	

	new Vue({
		el: '#dynmaicInput',
		data() {
			return {
				id: 0,
				inputs: []
			}
		},
		methods: {
			addInput () {
				this.inputs.push({
					id: this.id,
					username: this.username,
					password: this.password,
					qty: this.qty,
					lprice: this.lprice,
					uprice: this.uprice
				});
				// increment the id for the next input that will be created.
				this.id++;
			},
			sumAmount(input) {
				if(!isNaN(input.qty) && !isNaN(input.uprice)) {
					input.amount = input.qty * input.uprice
				} else {
					input.amount = ''
				}
				
				return input.amount
			}
		}
	})


    var app = new Vue({
        el: '#app',
        data() {
					return {
								inputs: [],
								lastnameOptions: [
									{ value: '', text: '... Select Last Name' },
									{ value: 'Cat', text: 'Cat' },
									{ value: 'Dog', text: 'Dog ' },
									{ value: 'Fish', text: 'Fish ' },
									{ value: 'Lion', text: 'Lion ' }
								],
								firstnameOptions: [
									{ value: '', text: '... Select First Name' },
									{ value: 'Terrain', text: 'Terrain' },
									{ value: 'Ocean', text: 'Ocean' },
									{ value: 'Landscape', text: 'Landscape' },
									{ value: 'Mountain', text: 'Mountain' }
								],
								selected: null,
								options: [
									{ value: '', text: '... Select Group' },
									{ value: 'VIP', text: 'VIP' },
									{ value: 'Normal', text: 'Normal ' },
									{ value: 'Junior', text: 'Junior ' },
									{ value: 'Senior', text: 'Senior ' }
									//{ value: { C: '3PO' }, text: 'This is an option with object value' },
									//{ value: 'd', text: 'This one is disabled', disabled: true }
								],
								genderOptions: [
									{ value: '', text: '... Select Gender' },
									{ value: 'Male', text: 'Male' },
									{ value: 'Female', text: 'Female ' }
								],
								fields: [
									{
										key: 'age',
										label: 'Age',
										sortable: true,
									},
									{ 
										key: 'name', label: 'Full Name' 
									},
									{
										key: 'first_name',
										label: 'First Name',
										sortable: true,
									},
									{
										key: 'last_name',
										label: 'Last Name',
										sortable: true,
									},
									{
										key: 'group',
										label: 'Group',
										sortable: true,
									},
									{
										key: 'gender',
										label: 'Gender',
										sortable: true,
									},
									{
										key: 'is_active',
										label: 'Is Active',
										sortable: true,
									},
									{ 
										key: 'actions', 
										label: 'Actions' 
									},
								],
								filtersFields: {
										  age: '',
										  first_name: '',
										  last_name: '',
										  group: '',
										  gender: '',
										  is_active: '',
										  actions: ''
								},
								items: [
									{ age: 40, name: { first: 'Dickerson', last: 'Macdonald' }, first_name: 'Dickerson', last_name: 'Macdonald', group: '', gender: 'Male', is_active: '1', actions: '' },
									{ age: 21, name: { first: 'Larsen', last: 'Shaw' }, first_name: 'Larsen', last_name: 'Shaw', group: 'Normal', gender: 'Female', is_active: '1', actions: '' },
									{ age: 89, name: { first: 'Geneva', last: 'Wilson' }, first_name: 'Geneva', last_name: 'Wilson', group: 'Normal', gender: '', is_active: '1', actions: '' },
									{ age: 38, name: { first: 'Jami', last: 'Carney' }, first_name: 'Jami', last_name: 'Carney', group: 'VIP', gender: '', is_active: '1', actions: ''}
								],
								infoModal: {
									id: 'info-modal',
									title: '',
									content: ''
								},
								iframeinfoModal: {
									id: 'iframeinfo-modal',
									title: '',
									content: ''
								},
								date: '',
			}
		},
		computed: {
		  filtered () {
		
			  const filtered = this.items.filter(item => {
					// Multi fields filter
					if(this.filtersFields['age']!='' || this.filtersFields['first_name']!='' || this.filtersFields['last_name']!=''
							|| this.filtersFields['group']!='' || this.filtersFields['gender']!='' || this.filtersFields['is_active']!='') 
					{
						var obj;
						var indexArr = ["age", "first_name", "last_name", "group", "gender", "is_active"];
						var counter=0;
						for(var i=0; i<indexArr.length; i++) {

							//if(this.filtersFields[indexArr[i]].includes('...')) {
								//this.filtersFields[indexArr[i]] = ''
							//}


							//this.filtersFields[indexArr[i]] = ""
							
							if(this.filtersFields[indexArr[i]]!="" && this.filtersFields[indexArr[i]]!=null) {
								if(counter==0) {
									obj = Object.keys(this.filtersFields).every(key => String(item[indexArr[i]]).includes(this.filtersFields[indexArr[i]]))
								} else {
									obj += Object.keys(this.filtersFields).every(key => String(item[indexArr[i]]).includes(this.filtersFields[indexArr[i]]))
								}
								counter++
								console.log("##########" + this.filtersFields[indexArr[i]]);
							}  else if(this.filtersFields[indexArr[i]]==null) {
								if(counter==0) {
									obj = Object.keys(this.filtersFields).every(key => String(item[indexArr[i]]).includes(""))
								} else {
									obj += Object.keys(this.filtersFields).every(key => String(item[indexArr[i]]).includes(""))
								}
								this.filtersFields[indexArr[i]]=''
								counter++
							}
						}

						return obj

					} else if(this.filtersFields['age']=='' && this.filtersFields['first_name']=='' &&
							this.filtersFields['last_name']=='' && this.filtersFields['group']=='' &&
							this.filtersFields['gender']=='' && this.filtersFields['is_active']=='') 
					{

						var obj = Object.keys(this.filtersFields).every(key => String(item[key]).includes(this.filtersFields[key]))
						return obj

					} else if(this.filtersFields['age']==null && this.filtersFields['first_name']==null &&
							this.filtersFields['last_name']==null && this.filtersFields['group']==null &&
							this.filtersFields['gender']==null && this.filtersFields['is_active']==null) 
					{

						var obj = Object.keys(this.filtersFields).every(key => String(item[key]).includes(this.filtersFields[key]))
						return obj

					} else {
						return Object.keys(this.filtersFields).every(key => String(item[key]).includes(this.filtersFields[key]))
					}
			  })

			  return filtered.length > 0 ? filtered : [
                    {
                        age: '',
						first_name: '',
						last_name: '',
						group: '',
						gender: '',
						is_active: '',
						actions: ''
					}
                ]
		  },
		  firstnamefiltered () {
			  const filtered = this.items.filter(item => {
					//return Object.keys(this.filtersFields).every(key => String(item['first_name']).includes(this.filtersFields['first_name']))
					return Object.keys(this.filtersFields).every(key => String(item['first_name']))
			  })

			  // create list for select box filter
			  var firstname= []; 
			  //firstname.push({ value: '', text: '... Select First Name' });
			  firstname.push('');
			  jQuery.each(filtered, function() {
					//var josn = { value: this.first_name, text: this.first_name }
					firstname.push(this.first_name)
					//firstname.indexOf(this.firstname) >= 0 ? false : firstname.push(this.firstname)
			  })

			  //console.log(JSON.stringify(filtered))
			  return firstname
		  },
		  lastnamefiltered () {
			  const filtered = this.items.filter(item => {
					//return Object.keys(this.filtersFields).every(key => String(item['last_name']).includes(this.filtersFields['last_name']))
					return Object.keys(this.filtersFields).every(key => String(item['last_name']))
			  })

			  // create list for select box filter
			  var lastname= []; 
			  lastname.push('');
			  jQuery.each(filtered, function() {
					//var josn = { value: this.last_name, text: this.last_name }
					lastname.push(this.last_name);
			  })

			  return lastname
		  },
		  groupfiltered () {
			  const filtered = this.items.filter(item => {
					return Object.keys(this.filtersFields).every(key => String(item['group']))
			  })

			  // create list for select box filter
			  var group= []; 
			  group.push('');
			  jQuery.each(filtered, function() {
					//var josn = { value: this.last_name, text: this.last_name }
					group.indexOf(this.group) >= 0 ? false : group.push(this.group)

					//group.push(this.group);
			  })

			  return group
		  },
		  genderfiltered () {
			  const filtered = this.items.filter(item => {
					return Object.keys(this.filtersFields).every(key => String(item['gender']))
			  })

			  // create list for select box filter
			  var gender= []; 
			  gender.push('');
			  jQuery.each(filtered, function() {
					//var josn = { value: this.last_name, text: this.last_name }
					gender.indexOf(this.gender) >= 0 ? false : gender.push(this.gender)
			  })

			  return gender
		  },
		  agefiltered () {
			  const filtered = this.items.filter(item => {
					return Object.keys(this.filtersFields).every(key => String(item['age']))
			  })

			  // create list for select box filter
			  var age= []; 
			  age.push('');
			  jQuery.each(filtered, function() {
					//var josn = { value: this.last_name, text: this.last_name }
					age.indexOf(this.age) >= 0 ? false : age.push(this.age)
			  })

			  return age
		  },
		},
		mounted() {
			// Set the initial number of items
			this.totalRows = this.items.length
		},
		methods: {
		  showModal() {
			this.$refs['my-modal'].show()
		  },
		  hideModal() {
			this.$refs['my-modal'].hide()
		  },
		  toggleModal() {
			// We pass the ID of the button that we want to return focus to
			// when the modal has hidden
			this.$refs['my-modal'].toggle('#toggle-btn')
		  },
		  info(item, index, button) {
			this.infoModal.title = `Row index: ${index}`
			//this.infoModal.content = JSON.stringify(item, null, 2)

			this.infoModal.content = item

			this.$root.$emit('bv::show::modal', this.infoModal.id, button)
		  },
		  iframeinfo(item, index, button) {
			this.iframeinfoModal.title = `Row index: ${index}`
			this.$root.$emit('bv::show::modal', this.iframeinfoModal.id, button)
			
			setTimeout(()=>{
			  this.loadIframe()
			  console.log('#############')
			}, 100)

		  },
		  okInfoModal() {
			console.log(JSON.stringify(this.items));

			//this.infoModal.title = ''
			//this.infoModal.content = ''
		  },
		  loadIframe() {
			$("#detailContent").html('<iframe width="100%" height="100%" frameborder="0" scrolling="yes" allowtransparency="true" src="http://localhost/fleet/keith/test-index"></iframe>');
		  },
		  okIframeInfoModal() {
			
			console.log(JSON.stringify(this.items));
		  },
		  closeModal() {
			this.$refs['my-modal'].hide()
		  },
		  closeIframeModal() {
			this.$refs['my-iframemodal'].hide()
		  },
		  onFiltered(filteredItems) {
			// Trigger pagination to update the number of buttons/pages due to filtering
			this.totalRows = filteredItems.length
			this.currentPage = 1
			}
		}
      })

</script>

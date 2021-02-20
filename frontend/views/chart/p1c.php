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
<div class="site-index">

    <div class="body-content">


		<div class="row">

            <div class="col-lg-12 col-sm-12">

				<div id="app">
					<div>
						<!-- :fields="fields" -->
						<!--  striped hover -->
						<!--  show-empty -->
						<b-table responsive sticky-headers 
								show-empty
								:fields="fields"
								:items="filtered"
								class="tableBlock">

							<template #cell(index)="data">
								#{{ data.index + 1 }}.
							</template>
					
							<template v-slot:cell(qt_category1)="data">
									{{ data.item.qt_category1}} | {{ data.item.qt_category2}} | {{ data.item.qt_category3}} | {{ data.item.qty}}件 | ${{ data.item.total}}

									&nbsp;&nbsp;&nbsp;&nbsp; &#8593; {{ data.item.percentage}}%
							</template>

							<template v-slot:cell(actions)="row">
								<b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
									||
								</b-button>
							</template>

						</b-table>
						
					</div>
			

					 <!-- Info modal -->
						<b-modal ref="my-modal" :id="infoModal.id" :title="infoModal.title" class="fadeIn">
							<b-table responsive sticky-headers stacked fixed thead-class="hidden_header" :items="detailItems" :fields="detailFields" class="tableBlock">
								<template v-slot:cell(brand)="data">
										{{ data.item.brand}} <br/>
										{{ data.item.receipt_prod_item }} <br/>
										{{ data.item.receipt_prod_amt }} <br/>
										{{ data.item.qt_category1 }} | {{ data.item.qt_category2 }} | {{ data.item.qt_category3 }}
										{{ data.item.qty }} | {{ data.item.total }}
								</template>
							</b-table>

							<template v-slot:modal-footer>
							<div class="w-100">
							  <p class="float-left"></p>
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
			 
				</div>
				<!-- vuejs components -->

			</div>

		</div>




        <div class="row">

            <div class="col-lg-4 col-sm-5">

                <?php
					
					$allTotal = 0;
					foreach($totalSpending as $total) {
						$allTotal = $allTotal + $total['total'];
					}

                    echo GoogleChart::widget(array('visualization' => 'PieChart',
                    'data' => array(
						array('Spend', 'Money per Day'),
                        array('Handbags', (int)$totalSpending[0]['total']),
                        array('Ready-to-wear', (int)$totalSpending[1]['total']),
                        array('Watches', (int)$totalSpending[2]['total']),
                        array('Accessories', (int)$totalSpending[3]['total']),
                        array('Shoes', (int)$totalSpending[4]['total']),
                        array('Jewellery', (int)$totalSpending[5]['total'])
                    ),
                    'options' => array('title' => 'Total Spending Amount: $' . $allTotal)));
					
                ?>

				<?php

                    echo GoogleChart::widget(array('visualization' => 'PieChart',
                    'data' => array(
						array('Spend', 'Money per Day'),
                        array('Handbags', (int)$noOfProductSold[0]['qty']),
                        array('Ready-to-wear', (int)$noOfProductSold[1]['qty']),
                        array('Watches', (int)$noOfProductSold[2]['qty']),
                        array('Accessories', (int)$noOfProductSold[3]['qty']),
                        array('Shoes', (int)$noOfProductSold[4]['qty']),
                        array('Jewellery', (int)$noOfProductSold[5]['qty'])
                    ),
                    'options' => array('title' => 'No. of Products Sold: $' . $allTotal)));

                  
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
										key: 'index', 
										label: '' 
									},
									{
										key: 'qt_category1',
										label: 'Top Category',
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

								detailFields: [
									{
										key: 'brand',
										label: '',
									},
								
								],
								detailItems: [],

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
		  
		},
		created() {
			this.initialData();
		},
		mounted() {
			// Set the initial number of items
			this.totalRows = this.items.length
		},
		methods: {
			initialData() {

				var data = { id: '' }

				this.$http.post('http://localhost/datachart/chart/top-category', data).then(response => {

				// get status
				response.status;

				// get status text
				response.statusText;

				// get 'Expires' headers
				response.headers.get('Expires');

				// get body data
				var message = response.body;
				//console.log(message);
				this.items = message;

			  }, response => {
				// error callback
			  });

			  

			},

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
			//this.infoModal.title = `Row index: ${index}`
			
			var data = { qt_category1: item.qt_category1, qt_category2: item.qt_category2, qt_category3: item.qt_category3 }
			
			this.$http.post('http://localhost/datachart/chart/top-category-sub-detail', data, {emulateJSON: true})
			.then(response => {
			   
				var message = response.body;
				console.log(JSON.stringify(message));
				this.detailItems = message;
				this.$root.$emit('bv::show::modal', this.infoModal.id, button)
			}, response => {
			   console.error(response.body);
			});
			
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

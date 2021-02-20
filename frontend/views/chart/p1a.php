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

    <div class="body-content" id="app">


		<div class="row">

            <div class="col-lg-3 col-sm-3">
				<div>
					<p class="text-center">Overall 中文</p>
					<b-table responsive sticky-headers stacked fixed thead-class="hidden_header" :items="overallItems" :fields="overallFields" class="tableBlock">
					
						<template v-slot:cell(brand)="data">
							<table style="border: 0px solid">
								<tr>
									<td>#{{ data.index + 1 }}.</td>
									<td>
										{{ data.item.brand}} <br/>
										{{ data.item.receipt_prod_item }} <br/>
										{{ data.item.receipt_prod_amt }} <br/>
										{{ data.item.qt_category1 }} | {{ data.item.qt_category2 }} | {{ data.item.qt_category3 }}
										{{ data.item.qty }} | {{ data.item.total }}
									</td>
								</tr>
							</table>
						</template>

					</b-table>
					
				</div>
			</div>

			
			<div class="col-lg-3 col-sm-3">
				<div>
					<p class="text-center">New Products</p>
					<b-table responsive sticky-headers stacked fixed thead-class="hidden_header" :items="newproductItems" :fields="newproductFields" class="tableBlock">
					<template v-slot:cell(brand)="data">
						<table style="border: 0px solid">
							<tr>
								<td>#{{ data.index + 1 }}.</td>
								<td>
									{{ data.item.brand}} <br/>
									{{ data.item.receipt_prod_item }} <br/>
									{{ data.item.receipt_prod_amt }} <br/>
									{{ data.item.qt_category1 }} | {{ data.item.qt_category2 }} | {{ data.item.qt_category3 }}
									{{ data.item.qty }} | {{ data.item.total }}
								</td>
							</tr>
						</table>
							
					</template>

					</b-table>
					
				</div>
			</div>


			<div class="col-lg-3 col-sm-3">
				<div>
					<p class="text-center">Female</p>
					<b-table responsive sticky-headers stacked fixed thead-class="hidden_header" :items="femaleItems" :fields="newproductFields" class="tableBlock">
					<template v-slot:cell(brand)="data">
						<table style="border: 0px solid">
							<tr>
								<td>#{{ data.index + 1 }}.</td>
								<td>
									{{ data.item.brand}} <br/>
									{{ data.item.receipt_prod_item }} <br/>
									{{ data.item.receipt_prod_amt }} <br/>
									{{ data.item.qt_category1 }} | {{ data.item.qt_category2 }} | {{ data.item.qt_category3 }}
									{{ data.item.qty }} | {{ data.item.total }}
								</td>
							</tr>
						</table>
					</template>

					</b-table>
					
				</div>
			</div>
				
			<div class="col-lg-3 col-sm-3">
				<div>
					<p class="text-center">Male</p>
					<b-table responsive sticky-headers stacked fixed thead-class="hidden_header" :items="maleItems" :fields="maleFields" class="tableBlock">
					<template v-slot:cell(brand)="data">
						<table style="border: 0px solid">
							<tr>
								<td>#{{ data.index + 1 }}.</td>
								<td>
									{{ data.item.brand}} <br/>
									{{ data.item.receipt_prod_item }} <br/>
									{{ data.item.receipt_prod_amt }} <br/>
									{{ data.item.qt_category1 }} | {{ data.item.qt_category2 }} | {{ data.item.qt_category3 }}
									{{ data.item.qty }} | {{ data.item.total }}
								</td>
							</tr>
						</table>
					</template>

					</b-table>
					
				</div>
			</div>
			

    </div>
</div>

<style>

	.tableBlock {
		height:600px; 
		max-height:600px;
		width:250px; 
		max-width:250px;
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
								overallFields: [
									{
										key: 'brand',
										label: '',
									},
								],
								overallItems: [],

								newproductFields: [
									{
										key: 'brand',
										label: '',
									},
								],
								newproductItems: [],

								femaleFields: [
									{
										key: 'brand',
										label: '',
									},
								],
								femaleItems: [],

								maleFields: [
									{
										key: 'brand',
										label: '',
									},
								],
								maleItems: [],

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

				this.$http.post('http://localhost/datachart/chart/hot-product-overall', data).then(response => {

				// get status
				response.status;

				// get status text
				response.statusText;

				// get 'Expires' headers
				response.headers.get('Expires');

				// get body data
				var message = response.body;
				console.log(message);
				this.overallItems = message;

			  }, response => {
				// error callback
			  });

			  
			  this.$http.post('http://localhost/datachart/chart/hot-product-new-products', data).then(response => {

				// get status
				response.status;

				// get status text
				response.statusText;

				// get 'Expires' headerss
				response.headers.get('Expires');

				// get body data
				var message = response.body;
				console.log(message);
				this.newproductItems = message;

			  }, response => {
				// error callback
			  });

			  
			  this.$http.post('http://localhost/datachart/chart/hot-product-female', data).then(response => {

				// get status
				response.status;

				// get status text
				response.statusText;

				// get 'Expires' headers
				response.headers.get('Expires');

				// get body data
				var message = response.body;
				console.log(message);
				this.femaleItems = message;

			  }, response => {
				// error callback
			  });

			  this.$http.post('http://localhost/datachart/chart/hot-product-male', data).then(response => {

				// get status
				response.status;

				// get status text
				response.statusText;

				// get 'Expires' headers
				response.headers.get('Expires');

				// get body data
				var message = response.body;
				console.log(message);
				this.maleItems = message;

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

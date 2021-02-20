<?php

/* @var $this yii\web\View */

$this->title = 'Appnovation';

$this->registerJsFile(
    '@web/js/' . Yii::$app->controller->id .'/index.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>
<div class="site-index">

    <div id="app" class="body-content">

		<div class="row">

            <b-overlay :show="show" rounded="lg">

                <div class="col-lg-12 col-sm-12">


				          
                        <b-form  @submit="onSubmit">
                        
                            <b-form-group id="input-group-2" 
                                label-cols-sm="5"
                                label-cols-lg="5"
                                    content-cols-sm="7"
                                    content-cols-lg="7"
                                label="Search Record" label-for="input-2">
                                <b-form-input
                                    id="input-2"
                                    v-model="form.keyword"
                                    placeholder=""
                                    required
                                ></b-form-input>
                            </b-form-group>

                            <b-button type="submit" variant="primary">Check Payment</b-button>
                           
                        </b-form>
                   
                        <b-table responsive sticky-headers 
								show-empty
								:fields="fields"
								:items="dataItems"
								class="tableBlock">

							<template #cell(index)="data">
								#{{ data.index + 1 }}.
							</template>
					
							<template v-slot:cell(name)="data">
									{{ data.item.name}}
							</template>

						</b-table>

                    <!-- show response message -->
                    <b-modal id="check-payment" no-close-on-backdrop cancelDisabled centered ok-only title="System Message">
                        <p class="my-4 text-center">{{ message}}</p>
                    </b-modal>
                   
			    </div>
            </b-overlay>
		</div>

        
    </div>
</div>

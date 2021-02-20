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

				          
                        <b-form  @submit="onSubmit" @reset="onReset">
                        
                            <b-form-group id="input-group-2" 
                                label-cols-sm="4"
                                label-cols-lg="4"
                                    content-cols-sm
                                    content-cols-lg="7"
                                label="Customer Name:" label-for="input-2">
                                <b-form-input
                                    id="input-2"
                                    v-model="form.name"
                                    placeholder="Enter name"
                                    required
                                ></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-2" 
                                label-cols-sm="4"
                                label-cols-lg="4"
                                    content-cols-sm
                                    content-cols-lg="7"
                                    label="Customer Phone:" label-for="input-2">
                            <b-form-input
                                id="input-2"
                                v-model="form.phone"
                                placeholder="Enter phone number"
                                type="number"
                                required
                            ></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-3" 
                                label-cols-sm="4"
                                label-cols-lg="4"
                                    content-cols-sm
                                    content-cols-lg="7"
                                label="Currency:" label-for="input-3">
                                <b-form-select
                                    id="input-3"
                                    v-model="form.currency"
                                    :options="currencyOptions"
                                    required
                                ></b-form-select>
                            </b-form-group>

                            <b-form-group id="input-group-2" 
                                label-cols-sm="4"
                                label-cols-lg="4"
                                    content-cols-sm
                                    content-cols-lg="7" 
                                    label="Price:" label-for="input-2">
                                <b-form-input
                                    id="input-2"
                                    v-model="form.price"
                                    placeholder="Enter price"
                                    type="number"
                                    required
                                ></b-form-input>
                            </b-form-group>
                          
                            <b-form-group label="Card Type"
                                    label-cols-sm="4"
                                label-cols-lg="4"
                                    content-cols-sm
                                    content-cols-lg="7"
                                v-slot="{ ariaDescribedby }">
                                <b-form-radio v-model="paymentdetail.cardtype" :aria-describedby="ariaDescribedby" name="some-radios" value="VISA">VISA</b-form-radio>
                                <b-form-radio v-model="paymentdetail.cardtype" :aria-describedby="ariaDescribedby" name="some-radios" value="AMEX">AMEX</b-form-radio>
                            </b-form-group>


                            <b-form-group id="input-group-2" 
                                label-cols-sm="4"
                                label-cols-lg="4"
                                    content-cols-sm
                                    content-cols-lg="7"
                                label="Card Holder Name:" label-for="input-2">
                                <b-form-input
                                    id="input-2"
                                    v-model="paymentdetail.cardholdername"
                                    placeholder=""
                                    required
                                ></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-2" 
                                label-cols-sm="4"
                                label-cols-lg="4"
                                    content-cols-sm
                                    content-cols-lg="7"
                                label="Card Number:" label-for="input-2">
                                <b-form-input
                                    id="input-2"
                                    v-model="paymentdetail.cardnumber"
                                    placeholder=""
                                    type="number"
                                    required
                                ></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-2" 
                                label-cols-sm="4"
                                label-cols-lg="4"
                                    content-cols-sm
                                    content-cols-lg="7"
                                label="Card Expire Date:" label-for="input-2">
                                <date-picker v-model="paymentdetail.cardexpirydate" :config="{format: 'DD-MM-YYYY'}"></date-picker>
                              
                            </b-form-group>

                            <b-form-group id="input-group-2" 
                                label-cols-sm="4"
                                label-cols-lg="4"
                                    content-cols-sm
                                    content-cols-lg="7"
                                label="Card CVV:" label-for="input-2">
                                <b-form-input
                                    id="input-2"
                                    v-model="paymentdetail.cardcvv"
                                    placeholder=""
                                    type="number"
                                    required
                                ></b-form-input>
                            </b-form-group>

                            <b-button type="submit" variant="primary">Create Payment</b-button>
                            <b-button type="reset" variant="danger">Reset</b-button>
                        </b-form>
                   

                    <!-- show response message -->
                    <b-modal id="create-payment" no-close-on-backdrop cancelDisabled centered ok-only title="System Message">
                        <p class="my-4 text-center">{{ message}}</p>
                    </b-modal>
                   
			    </div>
            </b-overlay>
		</div>

        
    </div>
</div>

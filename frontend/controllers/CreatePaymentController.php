<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\ResponseStriple;
use common\models\ResponsePaypal;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

/**
 * CreatePayment controller
 */
class CreatePaymentController extends BaseController
{
    /**
     * {@inheritdoc}
     */

    private $_refno;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSubmit() {
        
		$form = Yii::$app->request->post('form');
		$paymentdetail = Yii::$app->request->post('paymentdetail');

        // Gateway Rules
        if($paymentdetail['cardtype']=="AMEX" && $form['currency']=="USD") {
            // use Gateway A
            $result = $this->getGateway('A', $form, $paymentdetail);

            if($result) {
                return JSON::encode(array (
                                        array('status'=> '1', 'msg'=> "create payment is successful " . "Ref: " .  $this->_refno)
                                       )
                                );
			} else {
                return JSON::encode(array (
                                        array('status'=> '0', 'msg'=> "create payment not success")
                                       )
                                );
			}

        } else if($paymentdetail['cardtype']=="AMEX" && $form['currency']!="USD") {
            // return error
            return JSON::encode(array (
                                        array('status'=> '0', 'msg'=> 'AMEX is possible to use only for USD')
                                       )
                                );
      
		} else if($form['currency']=="USD" || $form['currency']=="EUR" || $form['currency']=="JPY") {
            // use Gateway A
            $result = $this->getGateway('A', $form, $paymentdetail);

            if($result) {
                return JSON::encode(array (
                                        array('status'=> '1', 'msg'=> " create payment is successful " . "Ref: " . $this->_refno)
                                       )
                                );
			} else {
                return JSON::encode(array (
                                        array('status'=> '0', 'msg'=> "create payment not success")
                                       )
                                 );
			}

		} else {
            // use Gateway B
            $result = $this->getGateway('B', $form, $paymentdetail);

            if($result) {
                return JSON::encode(array (
                                        array('status'=> '1', 'msg'=> " create payment is successful " . "Ref: " . $this->_refno)
                                       )
                                );
			} else {
                return JSON::encode(array (
                                        array('status'=> '0', 'msg'=> "create payment not success")
                                       )
                                );
			}
		}

    }

    public function getGateway($type, $form, $paymentdetail) {

        switch($type) {

            case 'A':
                return $this->_useStriple($form, $paymentdetail);
            break;

            case 'B':
                return  $this->_usePaypal($form, $paymentdetail);
            break;

		}
    
    }

    private function _useStriple($form, $paymentdetail) {

        $currency = strtolower($form['currency']);
        $source = $this->_getSource($paymentdetail['cardtype']);
        $amount = (int)$form['price'];
        $this->_refno = Yii::$app->security->generateRandomString(12);

        $stripe = new \Stripe\StripeClient("sk_test_51IM4oDHokZvyFmRURqOpDAAlb56t5t8mXvaKqXFFph7Yvqqqa856t9HGQMkkJ4K1vIXNrk2XZ8KC7TNLRV6Ce0QS00XcscrUc8");
        $response = $stripe->charges->create([
          "amount" => $amount,
          "currency" => $currency,
          "source" => $source,
          "metadata" => ["order_id" => $this->_refno]
        ]);

        $this->_savePaymentRecord($form);

        return $this->_saveStripleResponse($response);

    }   

    private function _usePaypal($form, $paymentdetail) {
        //https://github.com/paypal/Checkout-PHP-SDK
        // Creating an environment
        $clientId = "AfaGvFEEIV0jj2leCk2oQ3-Ubys3xpzRRbaWLNb2M4Yvb99xQAW5JQk_4yOOAUwYChcxkpaz66TYyfFU";
        $clientSecret = "EK2CDdSRVX1h4QO1PfvcVQq45xSws57pNR07slEx_BO0aDIkT68JZ9o3kNQIe-_hTypuTY_ducM6fKnI";

        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);

        $amount = (int)$form['price'];
        $this->_refno = Yii::$app->security->generateRandomString(12);

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
                             "intent" => "CAPTURE",
                             "purchase_units" => [[
                                 "reference_id" => $this->_refno,
                                 "amount" => [
                                     "value" => $amount,
                                     "currency_code" => $form['currency']
                                 ]
                             ]],
                             "application_context" => [
                                  "cancel_url" => "https://example.com/cancel",
                                  "return_url" => "https://example.com/return"
                             ] 
                         ];

        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);
    
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            
            $arr = ArrayHelper::toArray($response);
           
           $this->_savePaymentRecord($form);
           return $this->_savePaypalResponse($arr);

        }catch (HttpException $ex) {
            echo $ex->statusCode;
            //print_r((array)$ex->getMessage());
        }

    }

    private function _getSource($type) {
        // reference doc https://stripe.com/docs/testing
        switch($type) {
            case 'VISA':
                return 'tok_visa'; 
            break;

            case 'Mastercard':
                return 'tok_mastercard'; 
            break;

            case 'AMEX':
                return 'tok_amex'; 
            break;

            case 'JCB':
                return 'tok_jcb'; 
            break;
            
            case 'UnionPay':
                return 'tok_unionpay'; 
            break;

		}
	}

    private function _savePaymentRecord($form) {

        Yii::$app->redis->set($this->_refno, 
                                JSON::encode(array (
                                        array('name'=> $form['name'], 
                                            'referno'=> $this->_refno, 
                                            'phone'=> $form['phone'], 
                                            'currency'=> $form['currency'],
                                            'price'=> $form['price'])
                                       )
                                )
                        );
	
        if(Yii::$app->redis->exists($form['name'])) {
            // increment
		    $existingData = JSON::decode(Yii::$app->redis->get($form['name']));

			$result = ArrayHelper::merge($existingData, array (
                                                                array('name'=> $form['name'], 
                                                        'referno'=> $this->_refno, 
                                                        'phone'=> $form['phone'], 
                                                        'currency'=> $form['currency'],
                                                        'price'=> $form['price']
                                                        ))
														);

            Yii::$app->redis->set($form['name'], 
                                    JSON::encode(
                                                    $result
                                    )
                            );

	    } else {
            // new record with this name
            Yii::$app->redis->set($form['name'], 
                                    JSON::encode(array (
                                            array('name'=> $form['name'], 
                                                'referno'=> $this->_refno, 
                                                'phone'=> $form['phone'], 
                                                'currency'=> $form['currency'],
                                                'price'=> $form['price'])
                                            )
                                    )
                            );
        }


    }

    private function _saveStripleResponse($response) {
        
        $ResponseStriple = new ResponseStriple();
        $ResponseStriple->response_id = $response['id'];
        $ResponseStriple->object = $response['object'];
        $ResponseStriple->amount = (int)$response['amount'];
        $ResponseStriple->amount_captured = (int)$response['amount_captured'];
        $ResponseStriple->amount_refunded = (int)$response['amount_refunded'];
        $ResponseStriple->application = $response['application'];
        $ResponseStriple->application_fee = (int)$response['application_fee'];
        $ResponseStriple->application_fee_amount = (int)$response['application_fee_amount'];
        $ResponseStriple->balance_transaction = $response['balance_transaction'];
        $ResponseStriple->billing_details = JSON::encode($response['billing_details']);
        $ResponseStriple->calculated_statement_descriptor = $response['calculated_statement_descriptor'];
        $ResponseStriple->captured = $response['captured'];
        $ResponseStriple->created = $response['created'];
        $ResponseStriple->currency = $response['currency'];
        $ResponseStriple->customer = $response['customer'];
        $ResponseStriple->description = $response['description'];
        $ResponseStriple->destination = $response['destination'];
        $ResponseStriple->dispute = $response['dispute'];
        $ResponseStriple->disputed = $response['disputed'];
        $ResponseStriple->failure_code = $response['failure_code'];
        $ResponseStriple->failure_message = $response['failure_message'];
        $ResponseStriple->fraud_details = JSON::encode($response['fraud_details']);

        $ResponseStriple->invoice = $response['invoice'];
        $ResponseStriple->livemode = $response['livemode'];
        $ResponseStriple->metadata = $response['metadata'];
        $ResponseStriple->on_behalf_of = $response['on_behalf_of'];
        $ResponseStriple->response_order = $response['order'];
        $ResponseStriple->outcome = JSON::encode($response['outcome']);
        $ResponseStriple->paid = $response['paid'];
        $ResponseStriple->payment_intent = $response['payment_intent'];
        $ResponseStriple->payment_method = $response['payment_method'];
        $ResponseStriple->payment_method_details = JSON::encode($response['payment_method_details']);
        $ResponseStriple->receipt_email = $response['receipt_email'];
        $ResponseStriple->receipt_number = $response['receipt_number'];

        $ResponseStriple->receipt_url = $response['receipt_url'];
        $ResponseStriple->refunded = $response['refunded'];
        $ResponseStriple->refunds = JSON::encode($response['refunds']);
        $ResponseStriple->review = $response['review'];
        $ResponseStriple->shipping = $response['shipping'];
        $ResponseStriple->source = JSON::encode($response['source']);
        $ResponseStriple->source_transfer = $response['source_transfer'];
        $ResponseStriple->statement_descriptor = $response['statement_descriptor'];
        $ResponseStriple->statement_descriptor_suffix = $response['statement_descriptor_suffix'];
        $ResponseStriple->response_status = $response['status'];
        $ResponseStriple->transfer_data = $response['transfer_data'];
        $ResponseStriple->transfer_group = $response['transfer_group'];

        $ResponseStriple->status = 10;
        $ResponseStriple->created_at = time();
      
        // secure saving record to db
        return $this->saveToDb($ResponseStriple);

    }

    private function _savePaypalResponse($response) {

        $ResponsePaypal = new ResponsePaypal();
        $ResponsePaypal->statusCode = (int)$response['statusCode'];
        $ResponsePaypal->response_id = $response['result']['id'];
        $ResponsePaypal->intent = $response['result']['intent'];
        $ResponsePaypal->response_status = $response['result']['status'];
        $ResponsePaypal->purchase_units = JSON::encode($response['result']['purchase_units']);
        $ResponsePaypal->create_time = $response['result']['create_time'];
        $ResponsePaypal->links = JSON::encode($response['result']['links']);
        $ResponsePaypal->headers = JSON::encode($response['headers']);
        $ResponsePaypal->status = 10;
        $ResponsePaypal->created_at = time();
       
       // secure saving record to db
       return $this->saveToDb($ResponsePaypal);

    }

}

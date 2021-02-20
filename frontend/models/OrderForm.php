<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Order;
use common\models\Customer;
use common\models\Item; 
use common\models\OrderItem; 

/**
 * Order form
 */
class OrderForm extends Model
{
    public $customer_id;
    public $total_amount;
    public $item_id;
    public $item_qty;
  
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'total_amount', 'item_id'], 'trim'],
            [['customer_id', 'total_amount', 'item_id', 'item_qty'], 'required'],
        ];
    }

    /**
     * Order.
     *
     * @return Order|null the saved model or null if saving fails
     */
    public function createorder()
    {
    
        // find customer and item
        $customer = Customer::findOne(Yii::$app->user->identity->id);
        $item = Item::findOne($this->item_id);
        // create order
        $order = new Order();
        $order->total_amount = $item->price;
        $order->status = 1;
        $randNum1 = mt_rand(1000,9999);
        $randNum2 = mt_rand(1000,9999);
        $randNum3 = mt_rand(1000,9999);
        $order->order_no = $randNum1 . $randNum2 . $randNum3;
        $order->order_date = date("Y-m-d",time());
        $order->created_at = time();
        $order->updated_at = time();
        // Linking Customer to the Order
        $order->link('customer', $customer);
        
        $item->status = 1;
        $item->created_at = time();
        $item->updated_at = time();
        // Linking Order and Item, and then store in order_item table
        $order->link('items', $item);
        $order->save();
      
        //After Order is created, and then fill in each item detail
        $orderItem = OrderItem::findOneByOrderID($order->id);
        $orderItem->qty = $this->item_qty;
        $orderItem->status = 1;
        $orderItem->created_at = time();
        $orderItem->updated_at = time();
        $orderItem->save();
        return $order;

    }
}

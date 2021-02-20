<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "Order".
 *
 * @property int $id
 * @property string $customer_id
 * @property integer $invoice_id
 * @property string $order_no
 * @property integer $order_date
 * @property float $total_amount
 * @property int $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class ResponseStriple extends \yii\db\ActiveRecord //db
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'response_striple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['response_id'], 'required'],
            ['response_id' ,'unique'],
            [['id', 'updated_at', 'created_at', 'status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'response_id' => 'Response ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    public static function findOneByResponseId($recid)
    {
        return static::findOne(['response_id' => $recid]);
    }
}

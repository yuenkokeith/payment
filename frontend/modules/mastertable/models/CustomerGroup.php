<?php

namespace frontend\modules\mastertable\models;

use Yii;

/**
 * This is the model class for table "CustomerGroup".
 *

 */
class CustomerGroup extends \yii\db\ActiveRecord //db
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customergroup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id', 'discount', 'status', 'updated_at', 'created_at'], 'integer'],
            [['name', 'description'], 'string'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'discount' => 'discount',
            'description' => 'Description',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    public static function findOneByName($name)
    {
        return static::findOne(['name' => $name]);
    }
}

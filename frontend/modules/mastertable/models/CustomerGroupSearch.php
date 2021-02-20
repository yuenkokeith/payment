<?php

namespace frontend\modules\mastertable\models;

use Yii;
use frontend\modules\mastertable\models\CustomerGroup;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "CustomerGroup".
 *
 */
class CustomerGroupSearch extends CustomerGroup
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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

    public function search($params)
    {
        // ::find()->joinWith(['table1','table2'])
        $query = CustomerGroup::find();

        $dataProvider = new ActiveDataProvider([
                            'query' => $query,
                            'sort' => [
                                        'defaultOrder' => [
                                                        'id' => SORT_DESC,
                                                    ]
                                    ],
                            'pagination' => [ 'pageSize' => 5 ],
                        ]);

        $this->load($params);

        if(!$this->validate()) {
            return $dataProvider;
        }

        //$query->joinWith('author');

        $query->andFilterWhere(['like', 'customergroup.name', $this->name])
                ->andFilterWhere(['like', 'customergroup.description', $this->description])
                ->andFilterWhere(['like', 'customergroup.status', $this->status]);

        return $dataProvider;
    }

    public static function findOneByName($name)
    {
        return static::findOne(['name' => $name]);
    }
}

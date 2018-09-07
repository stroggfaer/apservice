<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property int $id
 * @property int $city_id
 * @property string $title
 * @property string $description
 * @property string $price
 * @property int $status
 *
 * @property City $city
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'status'], 'integer'],
            [['title'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['title'], 'string', 'max' => 60],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'City ID',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property int $city_id
 * @property string $title
 * @property int $status
 *
 * @property AppleServices[] $appleServices
 * @property City $city
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'status'], 'integer'],
            [['title'], 'required'],
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
            'city_id' => 'Город',
            'title' => 'Название района',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppleServices()
    {
        return $this->hasMany(AppleServices::className(), ['region_id' => 'id'])->where(['status'=>1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id'])->where(['status'=>1]);
    }
}
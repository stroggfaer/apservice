<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prices".
 *
 * @property int $id
 * @property int $city_id
 * @property int $device_problems_id
 * @property string $money
 * @property int $status
 *
 * @property City $city
 * @property DeviceProblems $deviceProblems
 */
class Prices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id','money','device_problems_id'], 'required'],
            [['city_id', 'device_problems_id', 'status'], 'integer'],
            [['money'], 'number'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['device_problems_id'], 'exist', 'skipOnError' => true, 'targetClass' => DeviceProblems::className(), 'targetAttribute' => ['device_problems_id' => 'id']],
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
            'device_problems_id' => 'Устройств проблем',
            'money' => 'Цена',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceProblems()
    {
        return $this->hasOne(DeviceProblems::className(), ['id' => 'device_problems_id']);
    }
}

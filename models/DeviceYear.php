<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_year".
 *
 * @property int $id
 * @property int $device_id
 * @property string $title
 * @property string $title_th1
 * @property string $title_th2
 * @property string $value1
 * @property string $value2
 * @property int $status
 *
 * @property Devices $device
 * @property DeviceYearDetails[] $deviceYearDetails
 */
class DeviceYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_year';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id'], 'required'],
            [['device_id', 'status'], 'integer'],
            [['title','value1','value2','title_th1','title_th2'], 'string', 'max' => 128],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['device_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_id' => 'Устройства',
            'title' => 'Название',
            'title_th1'=>'Название столбца1',
            'title_th2'=>'Название столбца2',
            'value1' => 'Значение1',
            'value2' => 'Значение2',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Devices::className(), ['id' => 'device_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceYearDetails()
    {
        return $this->hasMany(DeviceYearDetails::className(), ['device_year_id' => 'id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "devices_details".
 *
 * @property int $id
 * @property int $devices_id
 * @property int $group_id
 * @property int $status
 *
 * @property Devices $devices
 * @property GroupDeviceProblems $group
 */
class DevicesDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'devices_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['devices_id', 'device_problems_id', 'status'], 'integer'],
            [['devices_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['devices_id' => 'id']],
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
            'devices_id' => 'Devices ID',
            'device_problems_id' => 'Device Problems ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevices()
    {
        return $this->hasOne(Devices::className(), ['id' => 'devices_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceProblems()
    {
        return $this->hasOne(DeviceProblems::className(), ['id' => 'device_problems_id']);
    }
    public function getDeviceProblemsAll()
    {
        return $this->hasMany(DeviceProblems::className(), ['id' => 'device_problems_id']);
    }
}

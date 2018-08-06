<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_device_problems".
 *
 * @property int $id
 * @property string $title
 * @property int $positions
 * @property int $status
 *
 * @property DeviceProblems[] $deviceProblems
 * @property DevicesDetails[] $devicesDetails
 */
class GroupDeviceProblems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_device_problems';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['position', 'status'], 'integer'],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'position' => 'Позиция',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getDeviceProblems()
//    {
//        return $this->hasMany(DeviceProblems::className(), ['group_id' => 'id'])->
//            select('device_problems.*,prices.money')->leftJoin(Prices::tableName(),'prices.device_problems_id = device_problems.id')
//            ->where(['prices.status'=>1,'device_problems.status'=>1]);
//    }
//    public function getDeviceProblems()
//    {
//        return $this->hasMany(DeviceProblems::className(), ['group_id' => 'id'])->viaTable(Prices::tableName(), ['device_problems_id' => 'id']);
//
//    }


    public function getDeviceProblems()
    {
        return $this->hasMany(DeviceProblems::className(), ['group_id' => 'id'])->where(['status'=>1]);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevicesDetails()
    {
        return $this->hasMany(DevicesDetails::className(), ['group_id' => 'id']);
    }
}

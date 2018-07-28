<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_problems".
 *
 * @property int $id
 * @property int $group_id
 * @property string $titile
 * @property string $description
 * @property string $time
 * @property int $positions
 * @property int $status
 *
 * @property GroupDeviceProblems $group
 * @property Prices[] $prices
 */
class DeviceProblems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'device_problems';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['group_id', 'position', 'status'], 'integer'],
            [['group_id','title', 'description'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 258],
            [['time'], 'string', 'max' => 64],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => GroupDeviceProblems::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Группа',
            'title' => 'Названия',
            'description' => 'Описание',
            'time' => 'Время',
            'position' => 'Позиция',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(GroupDeviceProblems::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevicesDetails()
    {
        return $this->hasMany(DevicesDetails::className(), ['device_problems_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Prices::className(), ['device_problems_id' => 'id']);
    }

    public function getPrice()
    {
        return $this->hasOne(Prices::className(), ['device_problems_id' => 'id']);
    }
}

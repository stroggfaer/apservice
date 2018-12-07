<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [['description','url','value','seo_title','seo_keywords','seo_description','text'], 'string'],
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
            'value' => 'Значение',
            'text'=>'Текст',
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
    public function getDeviceYearDetails()
    {
        return $this->hasMany(DeviceYearDetails::className(), ['device_problem_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceYearDetail()
    {
        return $this->hasOne(DeviceYearDetails::className(), ['device_problem_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevicesDetail()
    {
        return $this->hasOne(DevicesDetails::className(), ['device_problems_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Prices::className(), ['device_problems_id' => 'id'])->where(['status'=>1]);
    }

    public function getPrice()
    {
        $city = \Yii::$app->action->currentCity;
        return $this->hasOne(Prices::className(), ['device_problems_id' => 'id'])->where(['city_id'=>$city->id]);
    }

    public function getDevice() {
        $devicesDetail = $this->devicesDetail;
        if(!empty($devicesDetail)) {
            return $devicesDetail->devices;
        }
        return false;
    }
    // Девайс;
    public function getDevices()
    {
        $devicesDetails= $this->devicesDetails;
        if(empty($devicesDetails)) return false;
        $data = [];
        //$items = ArrayHelper::map(array_merge($devicesDetails),'devices_id', 'name');
        foreach ($devicesDetails as $value) {
            if(!empty($value->devices->title)) {
                $data[] = $value->devices->title;
            }
        }
        $data = implode(', ',$data);
        return $data;
    }




}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "devices".
 *
 * @property int $id
 * @property int $menu_repair_id
 * @property string $url
 * @property string $title
 * @property int $positions
 * @property int $status
 *
 * @property MenuRepairs $menuRepair
 * @property DevicesDetails[] $devicesDetails
 */
class Devices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'devices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_repair_id', 'position', 'status'], 'integer'],
            [['title','menu_repair_id'], 'required'],
            [['url'], 'string', 'max' => 68],
            [['title'], 'string', 'max' => 128],
            [['menu_repair_id'], 'exist', 'skipOnError' => true, 'targetClass' => MenuRepairs::className(), 'targetAttribute' => ['menu_repair_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_repair_id' => 'Меню устройствы',
            'url' => 'Url',
            'title' => 'Название',
            'position' => 'Позиция',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuRepair()
    {
        return $this->hasOne(MenuRepairs::className(), ['id' => 'menu_repair_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevicesDetails()
    {
        return $this->hasMany(DevicesDetails::className(), ['devices_id' => 'id']);
    }


    // Список девайс;
    public function getDevices() {
       $devices = Devices::find()->where(['status'=>1])->orderBy('position DESC')->all();
       return $devices;
    }

    public function getDevice() {
        $device  = $this->devices[0];
        return $device;
    }
    // Список проблемы;
    public function getDeviceProblems() {
        $data = [];
        $device = $this->device;

        if(empty($device)) return false;

        foreach ($device->devicesDetails as $devicesDetail) {
            $data[] = $devicesDetail->deviceProblems;
        }

        return $data;
    }

    // Сохранить Id Devais;
    public function setDeviceIdSession($device_id)
    {
        $session = Yii::$app->session;
        $session->open();
        $_SESSION['devices']['device_id'] = $device_id;
        if(empty($device_id)) {
            unset($_SESSION['devices']['device_id']);
        }
        return false;
    }
    // Сохранить Id $device_problem_id;
    public function setDeviceProblemIdSession($device_problem_id)
    {
        $session = Yii::$app->session;
        $session->open();
        $_SESSION['devices']['device_problem_id'] = $device_problem_id;
        if(empty($device_problem_id)) {
            unset($_SESSION['devices']['device_problem_id']);
        }
        return false;
    }

    // Получить девайс;
    public function getDeviceOne()
    {
        $session = Yii::$app->session;
        if(empty($session['devices']['device_id'])) return false;
        return Devices::find()->where(['id'=>$session['devices']['device_id'],'status'=>1])->limit(1)->one();
    }

    // Получить список проблемы;
    public function getDeviceOneProblems()
    {
        $data = [];

        if(empty($this->deviceOne) && empty($this->deviceOne->devicesDetails)) return false;
        foreach ($this->deviceOne->devicesDetails as $devicesDetail) {
            $data[] = $devicesDetail->deviceProblems;
        }
        return $data;
    }

    // Получить девайс проблем;
    public function getDeviceProblemOne()
    {
        $session = Yii::$app->session;
        if(empty($session['devices']['device_problem_id'])) return false;
        return DeviceProblems::find()->where(['id'=>$session['devices']['device_problem_id'],'status'=>1])->limit(1)->one();
    }
}

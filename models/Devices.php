<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
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


    public $device_id;
    public $checkbox_copy = false;
    private $limit = 20; // Limit start;
    private $countLimit = 0; // Limit end;
    private $device_year_id;
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
            [['checkbox_copy'],'boolean'],
            [['url'], 'string', 'max' => 68],
            [['seo_title','seo_keywords','seo_description','text','title_h1','title_h3','description'],'string'],
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
            'checkbox_copy'=>'Копировать',
            'text'=>'Текст',
            'title_h1'=>'Заголовок H1',
            'title_h3'=>'Заголовок H3',
            'description'=>'Описание контент',
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
    public function getDevicesDetail()
    {
        return $this->hasOne(DevicesDetails::className(), ['devices_id' => 'id']);
    }
    public function getDeviceProblemsDefault() {
         return  $this->hasOne(DevicesDetails::className(), ['devices_id' => 'id'])->joinWith('deviceProblems')->where(['devices_details.status'=>1,'device_problems.status'=>1]);
    }

    public function getDeviceProblemsList()
    {
        $data = [];
        $devicesDetails = DevicesDetails::find()->where(['devices_id'=>$this->id,'status'=>1])->all();
        if(!empty($devicesDetails)) {
            foreach ($devicesDetails as $devicesDetail) {
                $data[] = $devicesDetail->deviceProblems;
            }
            return $data;
        }
        return $data;
    }


    // Список девайс;
    public function getDevices() {
       $devices = Devices::find()->where(['status'=>1])->orderBy('position ASC')->all();
       return $devices;
    }

    public function setDevice($device_id) {
        if(empty($device_id)) return false;
         return $this->device_id  = $device_id;
    }

    public function setLimit($countLimit) {
        return $this->countLimit  = $countLimit;
    }

    // Получаем Девайс;
    public function getDevice($id=false) {
        if(!empty($id)) {
            $device = Devices::findOne(['id'=>$id,'status'=>1]);
        }else{
            $device = $this->devices[0];
        }
        return $device;
    }

    // Список проблемы; Obj $device;
    public function getDeviceProblems($device = false,$limit = true) {
        $data = [];
        if(empty($device)) return false;
        //
        if(!empty($limit)) {
            if ($this->countLimit > 0) {
                $devicesDetails = $device->getDevicesDetails()->where(['status' => 1])->limit($this->countLimit)->orderBy('id ASC')->offset($this->limit)->all();
            } else {
                $devicesDetails = $device->getDevicesDetails()->where(['status' => 1])->limit($this->limit)->all();
            }
        }else{
            $devicesDetails = $device->getDevicesDetails()->where(['status' => 1])->all();
        }
        foreach ($devicesDetails as $devicesDetail) {
            $data[] = $devicesDetail->deviceProblems;
        }
        return $data;
    }

    // Количество осталось;
    public function getCountsLimit($device = false) {
        $data = [];
        if(empty($device)) return false;
        $counts = $device->getDevicesDetails()->where(['status'=>1])->count();

        $data['counts'] = !empty($counts) ? ($counts -= $this->limit) : 0;
        $data['counts'] = $data['counts'] > 0 ? $data['counts'] : 0;
        $data['limit'] = $this->limit;

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
    public function getDeviceOne($id = false)
    {
        $session = Yii::$app->session;
        if(empty($session['devices']['device_id'])) return false;
        if($id) {
            return Devices::find()->where(['id' => $id, 'status' => 1])->limit(1)->one();
        }else{
            return Devices::find()->where(['id' => $session['devices']['device_id'], 'status' => 1])->limit(1)->one();
        }
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
    public function getDeviceProblemOne($device_problem_id = false)
    {
        $session = Yii::$app->session;
        if(empty($session['devices']['device_problem_id'])) return false;
        if($device_problem_id) {
            return DeviceProblems::find()->where(['id' => $device_problem_id, 'status' => 1])->limit(1)->one();
        }else{
            return DeviceProblems::find()->where(['id' => $session['devices']['device_problem_id'], 'status' => 1])->limit(1)->one();
        }
    }

    // Список проблемы в массиве;
    public function getDeviceProblemsArrayList() {

        $device_problems_id = ArrayHelper::map(array_merge($this->devicesDetails),'id','device_problems_id');
        $deviceProblems = DeviceProblems::find()->select(['id','title'])->where(['status'=>1])->indexBy('id')->andWhere(['not in','id',$device_problems_id])->orderBy('id ASC')->all();
        if(!empty($deviceProblems)) {
            foreach ($deviceProblems as $key => $deviceProblem) {
                $deviceProblems[$key] = $deviceProblem->title .' '. Functions::money($deviceProblem->price->money). '.р (' .$deviceProblem->devices. ')';
            }
        }
        return $deviceProblems;
        //return ArrayHelper::map(array_merge(DeviceProblems::find()->where(['status'=>1])->andWhere(['not in','id',$device_problems_id])->orderBy('id ASC')->all()),'id','title');
    }

    /*------Режим прайса V 2.0.1;-------*/
    /*--Если меню устройства акт. show_prices = 1  -*/

    public function setDeviceYearId($device_year_id) {
        if(empty($device_year_id)) return false;
        return $this->device_year_id  = $device_year_id;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeviceYears()
    {
        return $this->hasMany(DeviceYear::className(), ['device_id' => 'id'])->where(['status'=>1]);
    }

    public function getDeviceYearOne($id = false) {
        if(empty($this->deviceYears)) return false;

        if(!empty($id)) {

            return $this->getDeviceYears()->where(['id'=>$id,'status'=>1])->one();
        }else{
            return  $this->deviceYears[0];
        }
    }
    //
    public function getDeviceDiagonalsOne($id = false,$device_year_id = false) {
        $deviceYearOne = $this->getDeviceYearOne($device_year_id);

        if(!empty($id)) {
            $deviceDiagonalOne = DeviceDiagonals::findOne($id);
            return $deviceDiagonalOne;
        }else{
            if(empty($deviceYearOne->deviceDiagonals)) return false;
            return  $deviceYearOne->deviceDiagonals[0];
        }
    }

    public function getDeviceProblemDefault() {
        if(empty($this->id)) return false;
        $devicesDetails = DevicesDetails::find()->where(['devices_id'=>$this->id])->one();
        return $devicesDetails->deviceProblems;
    }

}

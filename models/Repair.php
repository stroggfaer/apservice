<?php
namespace app\models;

use yii\base\Model;
use Yii;
use app\models\MenuRepairs;
/*
 * Repair version 1.2.0
 * */

class Repair extends Model
{

    private $devices;


    // Menu Repair;
    public function getMenuRepairs()
    {
        $data = MenuRepairs::find()->where(['status'=>1])->orderBy('position ASC')->all();
        return $data;
    }
    public function getMenuRepair()
    {
        $data = MenuRepairs::find()->where(['status'=>1])->orderBy('id ASC')->one();
        return $data;
    }
    // Menu Repair;
    public function getCurrentRepair($url = false)
    {
        $current = (!empty(\Yii::$app->request->queryParams['url']) ? trim(\Yii::$app->request->queryParams['url'], '/') : false);
        $url = !empty($url) ? $url :  $current;
        $data = MenuRepairs::find()->where(['status'=>1,'url'=>$url])->orderBy('position ASC')->one();
        if(!$data) return false;
        return $data;
    }

    // Список девайсы;
    public  function getDevices() {
        if(empty($this->currentRepair->devices)) return false;
        return $this->currentRepair->devices;
    }

    // Девайс;
    public function getCurrentDevices($alias = false) {
        if(!$alias) return false;
        $devices = Devices::find()->where(['url'=>$alias,'status'=>1])->one();
        if(empty($devices)) return false;
        $this->setDevices($devices);
        return $devices;
    }

    // Tекущие роблемы;
    public function getCurrentDeviceProblems($last = false) {
        if(!$last) return false;
        $deviceProblems = DeviceProblems::find()->where(['url'=>$last,'status'=>1])->one();
        if(empty($deviceProblems)) return false;
        return $deviceProblems;
    }


    public function setDevices(Devices $devices) {
         if(!empty($devices)) {
             $this->devices =  $devices;
             return  $this->devices;
         }
         return false;
    }

    public function getDevice() {
        if(!empty($this->devices)) {
            return  $this->devices;
        }
        return false;
    }

    // Список проблемы выбранного девайса;
    public function getDevicesProblems() {

       $data = [];
       $devices_alias =  Yii::$app->request->get();

       if(empty($devices_alias['alias'])) return false;

        $devices = Devices::find()->where(['url'=>$devices_alias['alias'], 'status'=>1])->one();
        if(!empty($devices->devicesDetails)) {
            foreach ($devices->devicesDetails as $devicesDetails) {
                $data[] = $devicesDetails->deviceProblems;
            }
        }
        return $data;
    }

    // Список проблемы группы;
    public function getDevicesProblemsGroups() {
       if(!empty($this->devices->id)) {
           $groupDeviceProblems = GroupDeviceProblems::find()
               ->leftJoin(DeviceProblems::tableName(), 'group_device_problems.id = device_problems.group_id')
               ->leftJoin(DevicesDetails::tableName(), 'devices_details.device_problems_id = device_problems.id')
               ->where(['devices_details.devices_id' => $this->devices->id, 'group_device_problems.status' => 1, 'device_problems.status' => 1])->orderBy('group_device_problems.position ASC')->all();
          if(empty($groupDeviceProblems)) return false;
          return $groupDeviceProblems;
       }
       return false;
    }

    // Обработка урл;
    public function getUrl($last = false)
    {
        $url =  Yii::$app->request->get();
        if(empty($url)) return false;
        return Yii::$app->getUrlManager()->createUrl('').$url['url'].'/'.$url['alias'].'/'.$last;
    }

    // Получить объект Девайс;
    public function getDeviceObj()
    {
        $device = new Devices();
        return $device;
    }

    // Apple Serves список сервисов;
    public function getAppleServices() {
         $city = \Yii::$app->action->currentCity;
         $appleServices = AppleServices::find()->where(['city_id'=>$city->id, 'status'=>1])->all();
         if(empty($appleServices)) return false;
         return $appleServices;
    }

    // Список районв;
    public function getRegions() {
        $city = \Yii::$app->action->currentCity;
        return Region::find()->where(['city_id'=>$city->id,'status'=>1])->all();
    }

}
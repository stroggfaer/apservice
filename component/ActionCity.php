<?php
namespace app\component;

use app\models\City;

use yii\base\Component;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\Functions;
use app\models\Options;

class ActionCity extends Component{

    public $title_h1;
    public $device_id;
    public $device_problems_id;

    public function init(){
        parent::init();

        //
    }

    // Определяем город; по умол. Новосибирск;
    public function getCurrentCity()
    {
        $options = Options::find()->where(['id'=>1000,'status'=>1])->one();

        // Если урл пустой в настройки то гео отключаем
        if(!empty($options->url)) {
            $subDomain = Functions::subDomain($_SERVER['HTTP_HOST']);
            $city = City::find()->where(['like', 'domen', $subDomain])->one();
            if (empty($city)) {
                header("Location: " . $options->url);
                exit();
            }
        }else{
            $city = City::find()->where(['status'=>1,'main'=>1])->one();
        }
        return  $city;
    }

    public function setTitleH1($title_h1) {
        if(empty($title_h1)) return false;
        return $this->title_h1 = $title_h1;
    }

    public function getTitleH1() {
        return $this->title_h1;
    }

    public function setDeviceId($device_id) {
        if(empty($device_id)) return false;
        return $this->device_id = $device_id;
    }

    public function getDeviceId() {
        return $this->device_id;
    }

    public function setDeviceProblemsId($device_problems_id) {
        if(empty($device_problems_id)) return false;
        return $this->device_problems_id = $device_problems_id;
    }

    public function getDeviceProblemsId() {
        return $this->device_problems_id;
    }

}
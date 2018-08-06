<?php
namespace app\component;

use app\models\City;

use yii\base\Component;
use Yii;
use yii\helpers\ArrayHelper;


class ActionCity extends Component{

    public function init(){
        parent::init();

        //
    }

    // Определяем город; по умол. Новосибирск;
    public function getCurrentCity()
    {
        $cookies = Yii::$app->request->cookies;
        $city_id = !empty($cookies->getValue('city_id')) ? $cookies->getValue('city_id') : 1001;
        $city = City::findOne($city_id);
        return  $city;
    }

}
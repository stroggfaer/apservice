<?php
namespace app\component;

use app\models\City;

use yii\base\Component;
use Yii;
use yii\helpers\ArrayHelper;
use app\models\Functions;
use app\models\Options;

class ActionCity extends Component{

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

}
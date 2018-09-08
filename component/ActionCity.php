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

        $subDomain = Functions::subDomain($_SERVER['HTTP_HOST']);
        $city = City::find()->where(['like', 'domen', $subDomain])->one();
        if(empty($city)) {
            if(!empty($options->url)) {
                header("Location: ".$options->url);
                exit();
            }else{
                header("Location: https://apple.sc/");
                exit();
            }
        }

        return  $city;
    }

}
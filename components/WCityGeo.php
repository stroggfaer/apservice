<?php
namespace app\components;

use app\models\Clients;
use app\models\fitness\UserFitness;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii;

class WCityGeo extends Widget{
    public $model;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
    }
    public function run(){
        if (!$this->model) {
            return false;
        }else {
          //  print_arr(Yii::$app->request->url);
            ?>
            <div class="items">
               <?php foreach ($this->model as $city): ?>

                   <div class="js-city-one" data-city-id="<?=$city->id?>"><a href="http://local.<?=$city->domen?>/repair/" class="city"><?=$city->name?></a></div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }
}
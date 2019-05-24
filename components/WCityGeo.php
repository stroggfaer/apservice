<?php
namespace app\components;

use yii\base\Widget;
use Yii;
use app\models\Options;


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
            $city = \Yii::$app->action->currentCity;
            $options = Options::find()->where(['id'=>1000,'status'=>1])->one();

            ?>
            <div id="city-modal" data-domen="<?=$city->domen?>">
                <div class="items">
                   <?php foreach ($this->model as $city): ?>
                       <?php if(!empty($city->main)): ?>
                          <div class="js-city-one" data-domen="<?=$city->domen?>"><a href="//asx.sc/repair/" class="city"><?=$city->name?></a></div>
                       <?php else: ?>
                           <div class="js-city-one" data-domen="<?=$city->domen?>"><a href="//<?=$city->domen?>.asx.sc/repair/" class="city"><?=$city->name?></a></div>
                       <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }
}
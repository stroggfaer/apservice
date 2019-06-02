<?php
namespace app\components;

use app\models\Functions;
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
            if(empty($options->url)) return 'Ошибка! Укажите имя вашего домена в настройке';
            $domain = Functions::domain($options->url);

            ?>
            <div id="city-modal" data-domen="<?=$city->domen?>">
                <div class="items">
                   <?php foreach ($this->model as $city): ?>
                       <?php if(!empty($city->main)): ?>
                          <div class="js-city-one" data-domen="<?=$city->domen?>"><a href="<?='//'.$domain.Functions::getUri()?>" class="city"><?=$city->name?></a></div>
                       <?php else: ?>
                           <div class="js-city-one" data-domen="<?=$city->domen?>"><a href="//<?=$city->domen.'.'.$domain.Functions::getUri()?>" class="city"><?=$city->name?></a></div>
                       <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }
}
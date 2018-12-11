<?php
namespace app\components;
use yii\base\Widget;
use app\models\Options;
use Yii;
use app\models\Functions;



class WSlides extends Widget{

    public function run(){
        $city = \Yii::$app->action->currentCity;
        $options = Options::find()->where(['id'=>1000,'status'=>1])->one();
        $title = !empty(\Yii::$app->action->titleH1) ? \Yii::$app->action->titleH1 : (!empty($options->title) ? $options->title : '');
        $device_id = !empty(\Yii::$app->action->device_id) ? \Yii::$app->action->device_id : false;
        $device_problems_id = !empty(\Yii::$app->action->device_problems_id) ? \Yii::$app->action->device_problems_id : false;
        ?>
           <div class="slides">
        <div class="container size-2">
            <h1 class="text-center"><?=Functions::getTemplateCode($title,$device_id,$device_problems_id);?></h1>
            <div class="row top">
                <div class="center-block">
                    <div class="col-xs-6 desktop">
                        <div class="icon-start01 icon__md"><div>Срочный ремонт 15 минут</div></div>
                        <div class="icon-start02 icon__md"><div>Гарантия на сделанный ремонт</div></div>
                    </div>
                    <div class="col-xs-6 desktop">
                        <div class="icon-start03 icon__md left"><div>10 точек по Новосибирску</div></div>
                        <div class="icon-start04 icon__md left"><div>Вызов курьера на дом</div></div>
                    </div>
                    <div class="clear"></div>
                    <div class="flex-bottom">
                        <div class="col  js-call-address">
                            <div class="icon-circle icon-phone"></div>
                            <div class="description">Позвонить нам</div>
                        </div>
                        <div class="col js-call-courier">
                            <div class="icon-circle icon-curer"></div>
                            <div class="description ">Вызвать курьера</div>
                        </div>
                        <div class="col js-call-master">
                            <div class="icon-circle icon-master"></div>
                            <div class="description ">Вызвать мастера</div>
                        </div>
                        <div class="col">
                            <a href="/contacts" class="no_border">
                              <div class="icon-circle icon-contacts"></div>
                              <div class="description">Приехать к нам</div>
                            </a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="text-center buttons desktop"><div class="btn btn-blue circle js-call-buttons">Узнать стоимость ремонта</div></div>
        </div>
    </div>
        <?php

    }
}
<?php
namespace app\components;
use yii\base\Widget;

use Yii;
use app\models\Functions;

class WSlides extends Widget{

    public function run(){
        $city = \Yii::$app->action->currentCity;
        ?>
           <div class="slides">
        <div class="container size-2">
            <h1 class="text-center">Ремонт Apple в <?=Functions::strEnd($city->name)?></h1>
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
                            <div class="icon-circle icon-contacts"></div>
                            <div class="description">Приехать к нам</div>
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
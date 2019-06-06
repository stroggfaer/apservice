<?php

use app\models\Options;
use yii\helpers\Html;
$this->params['breadcrumbs'][] = $pages->title;
$options = Options::find()->where(['id'=>1000,'status'=>1])->one();
// https://console.developers.google.com/google/maps-apis/apis/maps-backend.googleapis.com/metrics?project=asxmap-1559144430469&authuser=1&duration=PT1H

// AIzaSyAaKwRkxxmcJ48O-2LPNwWmZcT5jUPTG1c&callback=initMap
// AIzaSyAibeoKy-F_zPEssZQuGIJC5F6MagTQ1Ks

// AIzaSyAaKwRkxxmcJ48O-2LPNwWmZcT5jUPTG1c

$this->registerJsFile('//maps.googleapis.com/maps/api/js?key='.$options->map_key, ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/vendor/map/landcarte.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/map.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="contacts">
    <div class="container min-size">
        <h1 class="title"><?= $pages->title?></h1>

        <div class="map">
            <div id="map-service" data-geo='{"lat":"<?=$city->map_lat?>","lon":"<?=$city->map_lon?>"}' data-zoom="<?=$city->zoom?>"></div>
        </div>
        <h2 class="title">Сервисные центры в <a href="#" class="dashed text-blue js-city">г. <?=$city->name?></a></h2>
        <table class="table table-striped table-hover mobile__mod" id="map_table">
            <?php if(!empty($contacts)):

                ?>
                <?php foreach ($contacts as $contact): ?>
                    <?php $phone = !empty($city->value) ? $city->value : ($contact->phone ? $contact->phone : 'Нет')?>
                  <tr class="hidden map-content-pointer"  data-geo='{"lat":"<?=$contact->map_lat?>","lon":"<?=$contact->map_lon?>"}'>
                      <td>
                          <div class="content-data">
                              <h3><?=$contact->title?>"</h3>
                              <a href="tel:<?=$phone?>" class="callibri_phone"><?=$phone?></a>
                              <p><?=$city->name?>,<br/><?=$contact->address?> <?=$contact->level?></p>
                              <p class="subway"><?=$contact->metro?></p>
                              <p class="worktime"><?=$contact->time?></p>
                          </div>
                      </td>
                  </tr>
                  <tr>
                    <td class="image center" data-label="">
                        <img src="<?=$contact->img.'?'.time()?>" class="size-2">
                        <div class="name"><?=$contact->title?></div>
                    </td>
                    <td class="center address" data-label="Адрес">
                        <div class="tr"><?=$contact->address?></div>
                        <?php if(!empty($contact->level)): ?>
                           <div class="text-grey"><?=$contact->level?></div>
                        <?php endif; ?>
                    </td>
                    <td class="text-center center" data-label="Метро">
                        <div class="metro"><i class="icon-m"></i> <?=$contact->metro?></div>
                    </td>
                    <td class="center" data-label="Режим работы">
                        <div class="flex-center">
                            <div class="time">
                               <?=$contact->time?>
                            </div>
                        </div>
                    </td>
                    <td class="text-center center" data-label="Телефон"1>
                        <div class="phone"><?=$phone?></div>
                    </td>
                 </tr>
               <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td>Cкоро открытие!</td>
                </tr>
            <?php endif; ?>
        </table>
        <div class="text"><?=$pages->text?></div>
    </div>
</div>




<!--<table class="table table-striped table-hover mobile__mod">-->
<!--    <tr>-->
<!--        <td class="image center" data-label="">-->
<!--            <img src="/files/service/1001.jpg" class="size-2">-->
<!--            <div class="name">«Универсам»</div>-->
<!--        </td>-->
<!--        <td class="center address" data-label="Адрес">-->
<!--            <div class="tr">ул. Ленина 1,</div>-->
<!--            <div class="text-grey">2 этаж</div>-->
<!--        </td>-->
<!--        <td class="text-center center" data-label="Метро">-->
<!--            <div class="metro"><i class="icon-m"></i> Площадь Ленина</div>-->
<!--        </td>-->
<!--        <td class="center" data-label="Режим работы">-->
<!--            <div class="flex-center">-->
<!--                <div class="time">-->
<!--                    <div>Пн-Сб 10:00–21:00</div>-->
<!--                    <div>Вс 12:00–21:00 </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </td>-->
<!--        <td class="text-center center" data-label="Телефон"1>-->
<!--            <div class="phone">+7 (383) 292-41-07</div>-->
<!--        </td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td class="image center" data-label="">-->
<!--            <img src="/files/service/1001.jpg" class="size-2">-->
<!--            <div class="name">«Универсам»</div>-->
<!--        </td>-->
<!--        <td class="center address" data-label="Адрес">-->
<!--            <div class="tr">ул. Ленина 1,</div>-->
<!--            <div class="text-grey">2 этаж</div>-->
<!--        </td>-->
<!--        <td class="text-center center" data-label="Метро">-->
<!--            <div class="metro"><i class="icon-m"></i> Площадь Ленина</div>-->
<!--        </td>-->
<!--        <td class="center" data-label="Режим работы">-->
<!--            <div class="flex-center">-->
<!--                <div class="time">-->
<!--                    <div>Пн-Сб 10:00–21:00</div>-->
<!--                    <div>Вс 12:00–21:00 </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </td>-->
<!--        <td class="text-center center" data-label="Телефон"1>-->
<!--            <div class="phone">+7 (383) 292-41-07</div>-->
<!--        </td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td class="image center" data-label="">-->
<!--            <img src="/files/service/1001.jpg" class="size-2">-->
<!--            <div class="name">«Универсам»</div>-->
<!--        </td>-->
<!--        <td class="center address" data-label="Адрес">-->
<!--            <div class="tr">ул. Ленина 1,</div>-->
<!--            <div class="text-grey">2 этаж</div>-->
<!--        </td>-->
<!--        <td class="text-center center" data-label="Метро">-->
<!--            <div class="metro"><i class="icon-m"></i> Площадь Ленина</div>-->
<!--        </td>-->
<!--        <td class="center" data-label="Режим работы">-->
<!--            <div class="flex-center">-->
<!--                <div class="time">-->
<!--                    <div>Пн-Сб 10:00–21:00</div>-->
<!--                    <div>Вс 12:00–21:00 </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </td>-->
<!--        <td class="text-center center" data-label="Телефон"1>-->
<!--            <div class="phone">+7 (383) 292-41-07</div>-->
<!--        </td>-->
<!--    </tr>-->
<!--</table>-->



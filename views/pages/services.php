<?php

use app\models\Options;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = [
    'template' => "<li>{link}</li>\n", // шаблон для этой ссылки
    'label' => 'Контакты', // название ссылки
    'url' => ['/contacts/'] // сама ссылка
];
$this->params['breadcrumbs'][] = $appleService->title;
$options = Options::find()->where(['id'=>1000,'status'=>1])->one();
// https://console.developers.google.com/google/maps-apis/apis/maps-backend.googleapis.com/metrics?project=asxmap-1559144430469&authuser=1&duration=PT1H

// AIzaSyAaKwRkxxmcJ48O-2LPNwWmZcT5jUPTG1c&callback=initMap
// AIzaSyAibeoKy-F_zPEssZQuGIJC5F6MagTQ1Ks

// AIzaSyAaKwRkxxmcJ48O-2LPNwWmZcT5jUPTG1c

$this->registerJsFile('//maps.googleapis.com/maps/api/js?key='.$options->map_key, ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/vendor/map/landcarte.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('js/map.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


?>
<div class="apple-services">
    <div class="container min-size">
        <h1 class="title">г. <?=$city->name?> <?= $appleService->title?></h1>
        <div class="map">
            <div id="map-service" data-geo='{"lat":"<?=$city->map_lat?>","lon":"<?=$city->map_lon?>"}' data-zoom="<?=$city->zoom?>"></div>
        </div>
        <div class="alert alert-warning map-content-pointer" data-geo='{"lat":"<?=$appleService->map_lat?>","lon":"<?=$appleService->map_lon?>"}'>
            <div class="content-data hidden">
                <h3><?=$appleService->title?>"</h3>
                <a href="tel:<?=$appleService->phone?>" class="callibri_phone"><?=$appleService->phone?></a>
                <p><?=$city->name?>,<br/><?=$appleService->address?> <?=$appleService->level?></p>
                <p class="subway"><?=$appleService->metro?></p>
                <p class="worktime"><?=$appleService->time?></p>
            </div>
          <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-12 image">
                    <a href="<?=(!empty($appleService->value) ? $appleService->value : '/services/'.$appleService->url)?>" class="no_border"><img src="<?= $appleService->img.'?'.time()?>" class="size-2"/></a>
                </div>
                <div class="col-md-10 col-sm-9 col-xs-12 address">
                    <div class="title"><?= $appleService->title ?></div>
                    <div class="address"><?= $appleService->address ?></div>
                    <div class="metro"><i class="icon-m"></i><?= $appleService->metro ?></div>
                    <div class="time"><?= $appleService->time ?></div>
                    <div class="phone"><?= !empty($appleService->phone) ? $appleService->phone : $appleService->city->phone ?></div>
                </div>
          </div>
        </div>
        <div class="text"><?=$appleService->text?></div>
    </div>
    <div class="info-call">
        <h3 class="text-center">Бесплатная консультация и подбор сервиса</h3>
        <div class="small">Проконсультируем Вас по нашей горячей линии или отправим к Вам мастера</div>
        <div class="phone"><?=!empty($appleService->phone) ? $appleService->phone : $options->phone?></div>
    </div>
</div>




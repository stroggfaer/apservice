<?php
use yii\helpers\Html;
$this->params['breadcrumbs'][] = $pages->title;

?>
<div class="contacts">
    <div class="container min-size">
        <h1 class="title"><?= $pages->title?></h1>
        <div class="map">
            <div id="map-service"></div>
        </div>
        <h2 class="title">Сервисные центры в <a href="#" class="dashed text-blue">г. Новосибирск</a></h2>
        <table class="table table-striped table-hover mobile__mod">
            <tr>
                <td class="image center" data-label="">
                    <img src="/files/service/1001.jpg" class="size-2">
                    <div class="name">«Универсам»</div>
                </td>
                <td class="center address" data-label="Адрес">
                    <div class="tr">ул. Ленина 1,</div>
                    <div class="text-grey">2 этаж</div>
                </td>
                <td class="text-center center" data-label="Метро">
                    <div class="metro"><i class="icon-m"></i> Площадь Ленина</div>
                </td>
                <td class="center" data-label="Режим работы">
                    <div class="flex-center">
                        <div class="time">
                            <div>Пн-Сб 10:00–21:00</div>
                            <div>Вс 12:00–21:00 </div>
                        </div>
                    </div>
                </td>
                <td class="text-center center" data-label="Телефон"1>
                    <div class="phone">+7 (383) 292-41-07</div>
                </td>
            </tr>
            <tr>
                <td class="image center" data-label="">
                    <img src="/files/service/1001.jpg" class="size-2">
                    <div class="name">«Универсам»</div>
                </td>
                <td class="center address" data-label="Адрес">
                    <div class="tr">ул. Ленина 1,</div>
                    <div class="text-grey">2 этаж</div>
                </td>
                <td class="text-center center" data-label="Метро">
                    <div class="metro"><i class="icon-m"></i> Площадь Ленина</div>
                </td>
                <td class="center" data-label="Режим работы">
                    <div class="flex-center">
                        <div class="time">
                            <div>Пн-Сб 10:00–21:00</div>
                            <div>Вс 12:00–21:00 </div>
                        </div>
                    </div>
                </td>
                <td class="text-center center" data-label="Телефон"1>
                    <div class="phone">+7 (383) 292-41-07</div>
                </td>
            </tr>
            <tr>
                <td class="image center" data-label="">
                    <img src="/files/service/1001.jpg" class="size-2">
                    <div class="name">«Универсам»</div>
                </td>
                <td class="center address" data-label="Адрес">
                    <div class="tr">ул. Ленина 1,</div>
                    <div class="text-grey">2 этаж</div>
                </td>
                <td class="text-center center" data-label="Метро">
                    <div class="metro"><i class="icon-m"></i> Площадь Ленина</div>
                </td>
                <td class="center" data-label="Режим работы">
                    <div class="flex-center">
                        <div class="time">
                            <div>Пн-Сб 10:00–21:00</div>
                            <div>Вс 12:00–21:00 </div>
                        </div>
                    </div>
                </td>
                <td class="text-center center" data-label="Телефон"1>
                    <div class="phone">+7 (383) 292-41-07</div>
                </td>
            </tr>
        </table>
        <div class="text"><?=$pages->text?></div>
    </div>
</div>








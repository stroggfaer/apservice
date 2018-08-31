<?php
/**
 * Created by PhpStorm.
 * User: Strogg
 * Date: 03.08.2018
 * Time: 17:16
 */
$this->title = $one->title;
$content = \app\models\Content::find()->where(['status'=>1,'group_id'=>1002])->one();

?>
<div class="container size">
    <div class="devices-problems">
        <div class="text-center title-main"><h2>Выбрано устройство <?=$one->device->title?></h2></div>

        <?=  app\components\WDevices::widget(['model'=>$model,'menu'=>true,'one'=>$one])?>

        <div class="text-center title-main-1"><h2>Выберите проблему на <?=$one->device->title?></h2></div>
        <div class="devices__com list">
            <?=  app\components\WDevicesProblems::widget(['model'=>$model,'one'=>$one])?>

            <div class="clear"></div>
            <div class="more"><a href="#" class="text-blue dotted">Показать еще</a></div>
        </div>
    </div>
</div>
<div class="return-problem">
    <div class="container size">
        <div class="title"><h3><?=$one->description?> на <?=$one->device->title?></h3></div>
        <div>Цена в сервисах</div>
        <div class="price"><?=$one->price->money?> руб. / <?=$one->time?></div>
    </div>
</div>
<div class="container size">
    <?php if(!empty($content)): ?>
    <div class="description-seo padding">
        <div class="text"><?=$content->text?></div>
    </div>
    <?php endif; ?>
</div>
<div class="call-form-content salon">
    <div class="container size">
        <h3 class="text-center">Ближайщие салоны</h3>
        <form class="form__mod" role="form">
            <div class="row">
                <div class="form-group col-md-4  col-xs-4">
                    <label>Укажите устройство:</label>
                    <select class="form-control">
                        <option>---</option>
                        <option>iphone 4</option>
                    </select>
                </div>
                <div class="form-group col-md-4  col-xs-4">
                    <label>Укажите проблему:</label>
                    <select class="form-control">
                        <option>---</option>
                        <option>Вибро не работает</option>
                    </select>
                </div>
                <div class="form-group col-md-4  col-xs-4">
                    <label>Укажите проблему:</label>
                    <select class="form-control">
                        <option>---</option>
                        <option>Вибро не работает</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="apple-service">
    <div class="container size">
        <div class="item">
            <div class="row">
                <div class="col-md-3 col-xs-3 image">
                    <a href="#" class="no_border"><img src="/files/apple/10001.png" /></a>
                </div>
                <div class="col-md-5 col-xs-5 address-service">
                    <div class="title">ТРЦ "Аура"</div>
                    <div class="address">630049, г. Новосибирск,
                        ул. Красный проспект, 101 (0 этаж)</div>
                    <div class="metro">Сибирская</div>
                    <div class="time">Ежедневно 10:00 - 22:00</div>
                    <div class="phone">+7 (383) 322-58-60</div>
                </div>
                <div class="col-md-4 col-xs-4 block">
                    <div class="total">
                        <div class="problems">Замена аккумулятра на iphone 5</div>
                        <div class="content">
                            <div class="_icon-ap2 time">20 мин</div>
                            <div class="_icon-ap2 money">1 800 руб.</div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="info-call">
    <h3 class="text-center">Бесплатная консультация и подбор сервиса</h3>
    <div class="small">Проконсультируем Вас по нашей горячей линии или отправим к Вам мастера</div>
    <div class="phone">+7 (383) 239-31-06</div>
</div>
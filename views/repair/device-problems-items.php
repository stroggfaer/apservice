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
        <div class="text-center title-main"><h2>Выбрано устройство <?=$model->device->title?></h2></div>

        <?=  app\components\WDevices::widget(['model'=>$model,'menu'=>true,'one'=>$one])?>

        <div class="text-center title-main-1"><h2>Выберите проблему на <?=$model->device->title?></h2></div>
        <div class="devices__com list">
            <?=  app\components\WDevicesProblems::widget(['model'=>$model,'one'=>$one])?>
            <div class="clear"></div>
            <div class="more"><a href="#" class="text-blue dotted">Показать еще</a></div>
        </div>
    </div>
</div>

<div class="return-problem">
    <div class="container size">
        <div class="title"><h3><?=$one->description?> на <?=$model->device->title?></h3></div>
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
        <div class="update-salon">
           <?=app\components\WSalonForm::widget(['model'=>$model,'one'=>$one])?>
        </div>
    </div>
</div>

<div class="apple-service">
       <?=  app\components\WAppleServices::widget(['model'=>$model->appleServices])?>
</div>

<div class="info-call">
    <h3 class="text-center">Бесплатная консультация и подбор сервиса</h3>
    <div class="small">Проконсультируем Вас по нашей горячей линии или отправим к Вам мастера</div>
    <div class="phone">+7 (383) 239-31-06</div>
</div>
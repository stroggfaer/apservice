<?php
use app\models\Functions;
use app\models\Options;

$this->title = $one->title;

$content = \app\models\Content::find()->where(['status'=>1,'group_id'=>1002])->one();
$options = Options::find()->where(['id'=>1000,'status'=>1])->one();
$city = \Yii::$app->action->currentCity;
?>
<div class="container size">
    <div class="devices-problems">
        <div class="text-center title-main"><h2>Выбрано устройство <?=$model->device->title?></h2></div>

        <?=  app\components\WDevices::widget(['model'=>$model,'menu'=>true,'one'=>$one])?>

        <div class="text-center title-main-1"><h2>Выберите проблему на <?=$model->device->title?></h2></div>
        <div class="devices__com list">
            <div class="update-devices-problems">
                <?=  app\components\WDevicesProblems::widget(['model'=>$model,'one'=>$one])?>
            </div>
            <div class="clear"></div>
            <?php if(!empty($model->countsLimit['counts'])): ?>
               <div class="more"><a href="#" class="text-blue dotted js-limit-devices-problems" data-counts="<?=$model->countsLimit['counts']?>"  data-limit="<?=$model->countsLimit['limit']?>" data-device-id="<?=$model->device->id?>" data-devices-problems-id="<?=$one->id?>">Показать еще</a></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="return-problem">
    <div class="container size">
        <div class="title"><h3><?=$one->description?> на <?=$model->device->title?></h3></div>
        <div>Цена в сервисах</div>
        <div class="price"><?=Functions::money($one->price->money)?> руб. / <?=$one->time?></div>
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
    <?= app\components\WAppleServices::widget(['appleServices'=>$model->appleServices,'one'=>$one,'model'=>$model])?>
</div>

<div class="info-call">
    <h3 class="text-center">Бесплатная консультация и подбор сервиса</h3>
    <div class="small">Проконсультируем Вас по нашей горячей линии или отправим к Вам мастера</div>
    <div class="phone"><?=!empty($options->phone) ? $options->phone : $city->pnone?></div>
</div>
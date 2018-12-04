<?php
use app\models\Functions;
use app\models\Options;

//$this->title = $one->title;

$content = \app\models\Content::find()->where(['status'=>1,'group_id'=>1002])->one();
$options = Options::find()->where(['id'=>1000,'status'=>1])->one();
$city = \Yii::$app->action->currentCity;

?>
<div class="container size">
    <?=  app\components\WMenuRepairs::widget(['model'=>$model])?>
    <div class="devices-problems">
        <div class="text-center title-main"><div class="seo-title">Выбрано устройство <?=$model->device->title?></div></div>

        <?=  app\components\WDevices::widget(['model'=>$model,'menu'=>true,'one'=>$one])?>

        <div class="text-center title-main-1"><h2 class="seo-title">Выберите проблему на <?=$model->device->title?></h2></div>
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

<div class="return-problem" id="scroll-1001">
    <div class="container size">
        <div class="title"><h3><?=$one->description?> на <?=$model->device->title?></h3></div>
        <div>Цена в сервисах</div>
        <div class="price"><?=Functions::money(!empty($one->price->money) ? $one->price->money : 0)?> руб. / <?=$one->time?></div>
    </div>
</div>

<div class="container size">
    <?php $text = (!empty($one->text) ? $one->text : (!empty($content->text) ? $content->text : '')); ?>
    <div class="description-seo padding">
        <div class="text"><?=Functions::getTemplateCode($text,$model->device->id,$one->id)?></div>
    </div>

</div>

<div class="call-form-content salon">
    <div class="container size">
        <h3 class="text-center">Салоны рядом с вами</h3>
        <div class="update-salon">
           <?=app\components\WSalonForm::widget(['model'=>$model,'one'=>$one])?>
        </div>
    </div>
</div>

<div class="apple-service">
    <?php $regions = $model->getRegionsOne($model->regions[0]->id); ?>
    <?= app\components\WAppleServices::widget(['appleServices'=>$regions->appleServices,'one'=>$one,'model'=>$model])?>
</div>

<div class="info-call">
    <h3 class="text-center">Бесплатная консультация и подбор сервиса</h3>
    <div class="small">Проконсультируем Вас по нашей горячей линии или отправим к Вам мастера</div>
    <div class="phone"><?=!empty($options->phone) ? $options->phone : $city->phone?></div>
</div>
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
                    <label>Выбранно устройство:</label>
                    <select class="form-control">
                        <option>---</option>

                        <?php if(!empty($model->devices)): ?>
                            <?php foreach ($model->devices as $device): ?>
                                <?php $selected = !empty($one->device->id) && $device->id == $one->device->id ? 'selected': ''; ?>
                                <option value="<?=$device->id?>" <?=$selected?> ><?=$device->title?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group col-md-4  col-xs-4">
                    <label>Выбранно проблему:</label>
                    <select class="form-control">
                        <option>---</option>
                        <?php if(!empty($model->devicesProblems)): ?>
                            <?php foreach ($model->devicesProblems as $devicesProblems):
                                $selected = $one->id == $devicesProblems->id ? 'selected': '';
                            ?>
                              <option value="<?=$devicesProblems->id?>" <?=$selected?>><?=$devicesProblems->title?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group col-md-4  col-xs-4">
                    <label>Выберите район:</label>
                    <select class="form-control">
                        <option>---</option>
                        <?php if(!empty($model->appleServices)): ?>
                          <?php foreach ($model->regions as $region): ?>
                             <option value="<?=$region->id?>"><?=$region->title?></option>
                          <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
        </form>
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
<?php

use app\models\Options;
use yii\bootstrap\ActiveForm;
use app\models\Call;
use app\models\Functions;
use yii\helpers\Html;
$city = \Yii::$app->action->currentCity;
$content = \app\models\Content::find()->where(['status'=>1,'group_id'=>1001])->one();
$mainTitle = 'Ремонт '.$one->title.' в '.Functions::strEnd($city->name);
$this->params['breadcrumbs'][] = [
    'template' => "<li>{link}</li>\n", // шаблон для этой ссылки
    'label' => 'Ремонт', // название ссылки
    'url' => ['/repair/'] // сама ссылка
];
$this->params['breadcrumbs'][] = $mainTitle;
$options = Options::find()->where(['id'=>1000,'status'=>1])->one();
$call = new Call();

?>
<div class="page-devices-problems">
    <div class="container min-size">
       <h1 class="title-page"><?= Html::encode($mainTitle) ?></h1>
    </div>

    <?=  app\components\WDiagnosticsForm::widget(['model'=>$model])?>
    <div class="apple-services-list">
        <div class="flex">
            <div class="icons js-call-address" id="ya_call">
                <i class="icon-call-image"></i>
                <div class="name">Позвоните нам</div>
            </div>
            <div class="icons js-call-courier" id="ya_courier">
                <i class="icon-courier-image"></i>
                <div class="name">Вызвать курьера</div>
            </div>
            <div class="icons js-call-master" id="ya_master">
                <i class="icon-master-image"></i>
                <div class="name">Вызвать мастера</div>
            </div>
            <div class="icons" id="ya_email" onclick="yaCounter54017833.reachGoal('ya_email');">
                <a href="<?='mailto:'.$options->email?>" class="no_border" >
                  <i class="icon-email-image"></i>
                  <div class="name">Отправить Email</div>
                </a>
            </div>
            <div class="icons">
                <a href="/contacts" class="no_border">
                  <i class="icon-map-image"></i>
                  <div class="name">Приехать к нам</div>
                </a>
            </div>
        </div>
    </div>
    <div class="container-full">
        <div class="container min-size">

            <div class="devicesProblemsMenu">
                <?=  app\components\WMenuRepairs::widget(['model'=>$model,'classNames'=>'page-menu','select'=>true,'level'=>2])?>
            </div>
            <div class="devices-problems hidden">
                <?=  app\components\WDevices::widget(['model'=>$model,'menu'=>false,])?>
            </div>
        </div>
        <div class="container min-size">
            <div class="title-main-1"><div class="seo-title">Ремонт <?=$one->title?></div></div>
            <div class="update-devices-problems-list">
                <?php


                if(!empty($one->menuRepair->show_prices)): ?>
                    <?= app\components\WDevicesProblemsPriceList::widget(['model'=>$model])?>
                <?php else: ?>
                    <?=  app\components\WDevicesProblemsList::widget(['model'=>$model])?>
                <?php endif; ?>
            </div>
        </div>
        <div class="container min-size">
            <div class="description-seo">
                <?php
                  $title_h3 = (!empty($one->title_h3) ? $one->title_h3 : (!empty($content->title) ? $content->title : ''));
                  $text = (!empty($one->text) ? $one->text : (!empty($content->text) ? $content->text : ''));
                ?>

                <?php ?>
                <div class="text"><?=Functions::getTemplateCode($text,$one->id)?></div>
            </div>
        </div>
    </div>
</div>
<?php if(false): ?>
<div class="call-form-content">
    <div class="container size">
        <div class="text-center seo-title size-1">Бесплатная консультация и подбор сервиса</div>
        <div class="description text-center">Проконсультируем Вас по нашей горячей линии или отправим к Вам мастера </div>
        <div class="alert alert__js hidden text-center">
            <b class="name"></b>
        </div>
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form-inline form__mod circle js-form-ajax'],
            'enableAjaxValidation'   => true,
            'enableClientValidation' => true,
            'validateOnBlur'         => false,
            'validateOnType'         => false,
            'validateOnChange'       => false,
            'validateOnSubmit'       => true,
        ]); ?>
            <?= $form->field($call, 'fio')->textInput(['placeholder'=>'Ваше имя'])->label(false);?>
            <?= $form->field($call, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7 (999)-999-9999',
                 ])->textInput(['placeholder' => 'Контактный телефон'])->label(false);
            ?>
            <input type="hidden" name="call_title" value="<?=$one->title?>">
            <input type="hidden" name="call_form" value="true">
            <div class="form-group"><button class="btn btn-blue circle loading js-send-call" type="submit">Жду звонка</button></div>
        <?php ActiveForm::end(); ?> <!--./Форма-->
    </div>
</div>
<?php endif; ?>






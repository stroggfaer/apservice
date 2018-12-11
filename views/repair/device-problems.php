<?php
use yii\bootstrap\ActiveForm;
use app\models\Call;
use app\models\Functions;

$content = \app\models\Content::find()->where(['status'=>1,'group_id'=>1001])->one();

//$this->title = $one->title;

$call = new Call();

?>

<div class="container size">
    <?=  app\components\WMenuRepairs::widget(['model'=>$model])?>
    <div class="devices-problems">
        <br>
        <br>
        <br>
        <?php if(false): ?>
           <div class="text-center title-main"><div class="seo-title">Выбрано устройство <?=$one->title?></div></div>
        <?php endif; ?>
        <?=  app\components\WDevices::widget(['model'=>$model,'menu'=>true])?>

        <div class="text-center title-main-1"><div class="seo-title">Выберите проблему на <?=$one->title?></div></div>


        <?=  app\components\WDevicesProblemsGroups::widget(['model'=>$model])?>

        <div class="default-problems">
            <a href="#" class="black solid js-call-problems1">У меня другая проблемы</a>
            <a href="#" class="black solid js-call-problems2">У меня несколько проблем</a>
        </div>

    </div>
</div>

<div class="diagnostics">
    <?=  app\components\WDiagnosticsForm::widget()?>
</div>

<div class="container size">


       <div class="description-seo">
           <?php $title_h3 = (!empty($one->title_h3) ? $one->title_h3 : (!empty($content->title) ? $content->title : '')); ?>
        <div class="text-center title-main"><h3 class="seo-title"><?=Functions::getTemplateCode($title_h3,$one->id)?></h3></div>
           <?php $text = (!empty($one->text) ? $one->text : (!empty($content->text) ? $content->text : '')); ?>
        <div class="text"><?=Functions::getTemplateCode($text,$one->id)?></div>
    </div>

    <div class="update-devices-problems-list">
        <?=  app\components\WDevicesProblemsList::widget(['model'=>$model])?>
    </div>
</div>
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







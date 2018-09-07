<?php
use yii\bootstrap\ActiveForm;
use app\models\Call;


$content = \app\models\Content::find()->where(['status'=>1,'group_id'=>1001])->one();

$this->title = $one->title;

$call = new Call();

?>

<div class="container size">
    <div class="devices-problems">
        <div class="text-center title-main"><h2>Выбрано устройство <?=$one->title?></h2></div>
        <?=  app\components\WDevices::widget(['model'=>$model,'menu'=>true])?>

        <div class="text-center title-main-1"><h2>Выберите проблему на <?=$one->title?></h2></div>


        <?=  app\components\WDevicesProblemsGroups::widget(['model'=>$model])?>

        <div class="default-problems">
            <a href="#" class="black solid">У меня другая проблемы</a>
            <a href="#" class="black solid">У меня несколько проблем</a>
        </div>

    </div>
</div>

<div class="diagnostics">
    <?=  app\components\WDiagnosticsForm::widget()?>
</div>

<div class="container size">
    <?php if(!empty($content)): ?>
       <div class="description-seo">
        <div class="text-center title-main"><h2><?=$content->title?></h2></div>
        <div class="text"><?=$content->text?></div>
    </div>
    <?php endif; ?>
    <div class="update-devices-problems-list">
        <?=  app\components\WDevicesProblemsList::widget(['model'=>$model])?>
    </div>
</div>
<div class="call-form-content">
    <div class="container size">
        <h3 class="text-center">Бесплатная консультация и подбор сервиса</h3>
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







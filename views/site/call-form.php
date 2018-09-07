<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$group_id  = Yii::$app->request->post('group_id');

 ?>
<div class="alert alert-success alert__js hidden text-center">
    <b class="name"></b>
</div>
<div class="call-form">
    <!--Форма-->
    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form__mod js-form-ajax'],
        'enableAjaxValidation'   => true,
        'enableClientValidation' => true,
        'validateOnBlur'         => false,
        'validateOnType'         => false,
        'validateOnChange'       => false,
        'validateOnSubmit'       => true,
    ]); ?>
    <div class="small">* Обязательные поля</div>
    <?= $form->field($call, 'fio')->textInput(['placeholder' => 'Имя*'])->label(false) ?>
    <?= $form->field($call, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+7 (999)-999-9999',])->textInput(['placeholder' => 'Телефон*'])->label(false);?>
    <input type="hidden" name="group_id" value="<?=$group_id?>">
    <input type="hidden" name="call_form" value="true">
    <div class="form-group text-center"><button class="btn btn-success loading js-send-call" type="submit">Отправить</button></div>
    <?php ActiveForm::end(); ?> <!--./Форма-->
</div>

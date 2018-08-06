<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if($model->isNewRecord): ?>
        <div class="row">
            <?= $form->field($model, 'username',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'family_name',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'last_name',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone',['options'=>['class'=>'form-group col-sm-6']])->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+7 (999)-999-9999',
            ])->textInput(['maxlength' => 30]);
            ?>

            <?= $form->field($model, 'birthday',['options'=>['class'=>'form-group col-sm-6']])->widget(DateControl::classname(), [
                'displayFormat' => 'dd/MM/yyyy',
                'autoWidget' => false,
                'widgetClass' => 'yii\widgets\MaskedInput',
                'widgetOptions' => [
                    'options' => ['class'=>'form-control'],
                    'mask' => '99/99/9999'
                ],
            ]);?>
            <?= $form->field($model, 'email',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'password_repeat',['options'=>['class'=>'form-group col-sm-6']])->passwordInput() ?>
            <?= $form->field($model, 'password',['options'=>['class'=>'form-group col-sm-6']])->passwordInput() ?>
            <?= $form->field($model, 'post',['options'=>['class'=>'form-group col-sm-6']])->passwordInput() ?>
        </div>
        <?= $form->field($model, 'type')->checkbox(['disabled' => false,]) ?>
        <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php else: ?>
        <div class="row">
            <?= $form->field($model, 'username',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'name',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'family_name',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'last_name',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'phone',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'birthday',['options'=>['class'=>'form-group col-sm-6']])->widget(DateControl::classname(), [
                'displayFormat' => 'dd/MM/yyyy',
                'autoWidget' => false,
                'widgetClass' => 'yii\widgets\MaskedInput',
                'widgetOptions' => [
                    'options' => ['class'=>'form-control'],
                    'mask' => '99/99/9999'
                ],
            ]);?>
            <?= $form->field($model, 'post',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>
        </div>
        <?= $form->field($model, 'type')->checkbox(['disabled' => false,]) ?>
        <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>

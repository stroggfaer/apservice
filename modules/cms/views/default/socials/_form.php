<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Socials */
/* @var $form yii\widgets\ActiveForm */
$type = [
    1 =>'Соцкнопок ',
    2 =>'Мессенджер',
];
$params = ['prompt' => '---', 'options' => [$model->type=>['selected'=>'selected']]];
?>

<div class="socials-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true])->hint('<a href="https://fontawesome.ru/all-icons/" target="_blank">Fontawesome иконки</a>') ?>

    <?=$form->field($model, 'type')->DropDownList($type, $params)?>

    <?= $form->field($model, 'href')->textInput(['maxlength' => true]) ?>
    <?php if($model->isNewRecord): ?>
        <?php $position = \app\models\Socials::find()->select('position')->where(['status'=>1])->orderBy('id DESC')->one(); ?>
        <?php if(!empty($position)): ?>
             <?= $form->field($model, 'position')->textInput(['value'=>$position->position + 1]) ?>
        <?php endif; ?>
    <?php else: ?>
        <?= $form->field($model, 'position')->textInput() ?>
    <?php endif; ?>

    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

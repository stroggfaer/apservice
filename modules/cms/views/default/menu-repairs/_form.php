<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MenuRepairs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-repairs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint('Только латинские буквы и цифры. Можно не заполнять.') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'title1')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description1')->textarea(['rows' => 4]) ?>
    <?= $form->field($model, 'title2')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description2')->textarea(['rows' => 4]) ?>

    <?php if($model->isNewRecord): ?>
        <?php $position = \app\models\MenuRepairs::find()->select('position')->where(['status'=>1])->orderBy('id DESC')->one();
        $positionValue =  !empty($position) ? $position->position + 1 : 1 ?>
        <?= $form->field($model, 'position')->textInput(['value'=>$positionValue]) ?>
    <?php else: ?>
        <?= $form->field($model, 'position')->textInput() ?>
    <?php endif; ?>
    <?= $form->field($model, 'icon')->textInput(['maxlength' => true])
        ->hint('Доступные классы: icon-iphone,icon-ipad,icon-mac,icon-watch,icon-tv') ?>
    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

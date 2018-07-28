<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\City */
/* @var $form yii\widgets\ActiveForm */


$parent = \app\models\Country::find()->orderBy('id ASC')->all();
$items = ArrayHelper::map(array_merge($parent),'id', 'title');
$params = ['prompt' => 'Выберите устройства', 'options' => [$model->country_id=>['selected'=>'selected']]];
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <?=$form->field($model, 'country_id',['options'=>['class'=>'form-group col-sm-6']])->DropDownList($items, $params);  ?>

        <?= $form->field($model, 'domen',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'name',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'seo_name',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>
    </div>
    <div class="clear"></div>
    <?= $form->field($model, 'seo_description')->textarea(['rows' => 6]) ?>
    <div class="row">
        <?= $form->field($model, 'time',['options'=>['class'=>'form-group col-sm-3']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone',['options'=>['class'=>'form-group col-sm-3']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'map_lat',['options'=>['class'=>'form-group col-sm-3']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'map_lon',['options'=>['class'=>'form-group col-sm-3']])->textInput(['maxlength' => true]) ?>
    </div>
    <div class="clear"></div>
    <?= $form->field($model, 'zoom')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'main')->checkbox(['disabled' => false,]) ?>
    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

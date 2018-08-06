<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\CitySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'country_id') ?>

    <?= $form->field($model, 'domen') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'seo_name') ?>

    <?php // echo $form->field($model, 'seo_description') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'map_lat') ?>

    <?php // echo $form->field($model, 'map_lon') ?>

    <?php // echo $form->field($model, 'zoom') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

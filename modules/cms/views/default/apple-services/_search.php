<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\cms\models\AppleServicesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="apple-services-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'city_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'title_seo') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'metro') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'map_lat') ?>

    <?php // echo $form->field($model, 'map_lon') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'value') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

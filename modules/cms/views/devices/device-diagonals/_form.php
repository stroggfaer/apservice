<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceDiagonals */
/* @var $form yii\widgets\ActiveForm */
$deviceProblems = \app\models\DeviceProblems::find()->select(['title','id'])->where(['status'=>1])->orderBy('id ASC')->indexBy('id')->asArray()->column();
$params = ['prompt' => 'Выберите проблемы', 'options' => [$model->device_problem_id=>['selected'=>'selected']]];
?>

<div class="device-diagonals-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

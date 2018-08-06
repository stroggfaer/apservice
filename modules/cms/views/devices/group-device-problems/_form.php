<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GroupDeviceProblems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="group-device-problems-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord): ?>
        <?php $position = \app\models\GroupDeviceProblems::find()->select('position')->where(['status'=>1])->orderBy('id DESC')->one();
        $positionValue =  !empty($position) ? $position->position + 1 : 1 ?>
        <?= $form->field($model, 'position')->textInput(['value'=>$positionValue]) ?>
    <?php else: ?>
        <?= $form->field($model, 'position')->textInput() ?>
    <?php endif; ?>

    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

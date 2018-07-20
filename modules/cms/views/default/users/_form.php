<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
      <?php if($model->isNewRecord): ?>

         <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

         <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

          <?= $form->field($model, 'password_repeat')->passwordInput() ?>

          <?= $form->field($model, 'password')->passwordInput() ?>

         <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

          <div class="form-group">
              <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
          </div>

       <?php else: ?>
          <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

          <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>



          <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

          <div class="form-group">
              <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
          </div>
       <?php endif; ?>
    <?php ActiveForm::end(); ?>

</div>

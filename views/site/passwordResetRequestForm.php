<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Забыли пароль';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success"><b> <?= Yii::$app->session->getFlash('success')?></b></div> <!-- For success message -->
    <?php elseif(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger"><b> <?= Yii::$app->session->getFlash('success')?></b></div> <!-- For success message -->
    <?php else: ?>
    <p>Если Вы забыли пароль, можете воспользоваться этой формой для его восстановления. Вы получите письмо на свою электронную почту с соответствующими инструкциями.</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <?php endif; ?>
</div>
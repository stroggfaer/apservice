<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Options;
$options = Options::find()->where(['id'=>1000,'status'=>1])->one();

$this->title = $options->title.' - Доступ к CMS';

?>

<div id="login" class="form_box__mod">
    <div class="row form-center">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel">
                <div class="panel-heading">
                    <h2 class="panel-title text-center">Вход в Админ</h2>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'options'=>['class'=>'form__mod'],

                        //   'enableAjaxValidation'   => true,
                        //  'enableClientValidation' => true,
                        'validateOnBlur' => false,
                        'validateOnType' => false,
                        'validateOnChange' => false,
                        'validateOnSubmit' => true,
                    ]); ?>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false); ?>

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "{input}<span class='checkbox-label'>{label}</span>",
                    ]) ?>
                    <?= Html::submitButton('Войти',  ['class' => 'btn btn-bg grey btn-block', 'name' => 'login-button']) ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\sliders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sliders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'buttons')->textarea(['rows' => 3])->
        hint('<xmp>
                Пример разметка:<div class="buttons"><button class="btn btn-red circle js-sign-up">Название</button>
                <div class="m-text">Бесплатная диагностика вашего устройства</div></div>
                </xmp>'); ?>
    <?= $form->field($model, 'value')->textarea(['rows' => 3]) ?>

    <?= $form->field($image, 'imageMax')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
            'multiple' => false
        ],
    ])->label('Загрузить баннер'); ?>
    <div class="images form-content-images ">
        <?php echo Html::img($model->img,['width'=>'300']); ?>
    </div>
    <?= $form->field($model, 'position')->textInput() ?>

    <?= $form->field($model, 'show_text')->checkbox(['disabled' => false,]) ?>

    <?= $form->field($model, 'show_button')->checkbox(['disabled' => false,]) ?>

    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

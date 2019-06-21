<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\FileInput;
use app\models\Functions;
/**
 * @var yii\web\View $this
 * @var app\models\Reviews $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="reviews-form">

    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);
        echo Form::widget([

            'model' => $model,
            'form' => $form,
            'columns' => 1,
            'attributes' => [
                'name' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Имя...', 'maxlength' => 128]],
                'description' => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Описание...', 'maxlength' => 128]],
                'text' => ['type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => 'Текст...','rows' => 6]],
                'status' => ['type' => Form::INPUT_CHECKBOX, 'options' => ['disabled' => false,]],
            ]
        ]);
    ?>
    <div class="images form-content-images ">
        <?php if(Functions::isPathFile('/review/'.$model->id.'.jpg')): ?>
            <i class="glyphicon glyphicon-remove js-delete-image-file" data-file-name="review/<?=$model->id.'.jpg'?>" ></i>
        <?php endif; ?>
        <?php echo Html::img($model->img,['width'=>'100']); ?>
    </div>
    <?php
    echo Form::widget([
        'model' => $images,
        'form' => $form,
        'columns' => 1,
        'attributes' => [
            'imageMax'=>['type' => Form::INPUT_FILE,  'label'=>'Загрузить фото', 'options' => ['accept' => 'image/*','multiple' => false]],
        ]
    ]);

    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Сохранить') : Yii::t('app', 'Обновить'),
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
    );
    ActiveForm::end(); ?>

</div>

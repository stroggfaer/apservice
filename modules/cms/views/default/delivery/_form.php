<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\widgets\FileInput;
use app\models\Functions;

/* @var $this yii\web\View */
/* @var $model app\models\Delivery */
/* @var $form yii\widgets\ActiveForm */
$city = ArrayHelper::map(array_merge(\app\models\City::find()->orderBy('id ASC')->all()),'id', 'name');
$params = ['prompt' => 'Выберите город', 'options' => [$model->city_id=>['selected'=>'selected']]];
?>

<div class="delivery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'city_id')->DropDownList($city, $params);  ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>

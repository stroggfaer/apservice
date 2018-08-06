<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Prices */
/* @var $form yii\widgets\ActiveForm */
$city = \app\models\City::find()->orderBy('id ASC')->all();
$items = ArrayHelper::map(array_merge($city),'id', 'name');
$params = ['prompt' => 'Выберите город', 'options' => [$model->city_id=>['selected'=>'selected']]];


$parent1 = \app\models\DeviceProblems::find()->orderBy('id ASC')->all();
$items1 = ArrayHelper::map(array_merge($parent1),'id', 'title');
$params1 = ['prompt' => 'Выберите проблемы', 'options' => [$model->device_problems_id=>['selected'=>'selected']]];
?>

<div class="prices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'city_id')->DropDownList($items, $params);  ?>

    <?=$form->field($model, 'device_problems_id')->DropDownList($items1, $params1);  ?>

    <?= $form->field($model, 'money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

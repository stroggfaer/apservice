<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Devices */
/* @var $form yii\widgets\ActiveForm */

// Загрузка пользователи;
$parent = \app\models\MenuRepairs::find()->orderBy('id ASC')->all();
$items = ArrayHelper::map(array_merge($parent),'id', 'title');
$params = ['prompt' => 'Выберите устройства', 'options' => [$model->menu_repair_id=>['selected'=>'selected']]];
?>

<div class="devices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'menu_repair_id')->DropDownList($items, $params);  ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint('Только латинские буквы и цифры. Можно не заполнять.') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord): ?>
        <?php $position = \app\models\Devices::find()->select('position')->where(['status'=>1])->orderBy('id DESC')->one();
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

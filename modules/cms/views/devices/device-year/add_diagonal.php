<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\DeviceYear */
$deviceDiagonals = \app\models\DeviceDiagonals::find()->select(['title','id'])->where(['status'=>1])->orderBy('id ASC')->indexBy('id')->asArray()->column();
$params = ['prompt' => 'Выберите диагональ'];
$deviceProblems = $devices->deviceProblemsArrayList;
?>
<div class="device-year-create">
    <?php $form = ActiveForm::begin(); ?>
        <?=$form->field($model, 'device_diagonal_id')->DropDownList($deviceDiagonals, $params);  ?>
        <?php if(!empty($deviceProblems)): ?>
            <?= $form->field($model, 'device_problem_id')->widget(Select2::classname(), [
                'data' =>  $deviceProblems,
                'maintainOrder' => true,
                'options' => ['placeholder' => 'Введите список проблемы ...', 'multiple' => true],
                'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [',', ' '],
                    'maximumInputLength' => 30
                ],
            ])->label('Добавить проблемы'); ?>
        <?php endif; ?>
       <?= Html::submitButton('Добавить', ['class' =>'btn btn-danger']) ?>
    <?php ActiveForm::end(); ?>
</div>

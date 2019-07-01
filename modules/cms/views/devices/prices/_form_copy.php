<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Prices */
/* @var $form yii\widgets\ActiveForm */

// Prices
$city = \app\models\City::find()->orderBy('id ASC')->all();
$copyCity = [];
$selectCity = [];
if(!empty($city)) {
    foreach ($city as $value) {
        if(count($value->prices) > 0) {
            $copyCity[] = $value;
        }else{
            $selectCity[] = $value;
        }
    }
}
$items1 = ArrayHelper::map(array_merge($copyCity),'id', 'name');
$items2 = ArrayHelper::map(array_merge($selectCity),'id', 'name');


$params1 = ['prompt' => 'Выберите город', 'options' => [$model->city_id=>['selected'=>'selected']]];
$params2 = ['prompt' => 'Выберите город', 'options' => [$model->city_id=>['selected'=>'selected']]];

//$parent1 = \app\models\DeviceProblems::find()->orderBy('id ASC')->all();
//$items1 = ArrayHelper::map(array_merge($parent1),'id', 'title');
//$params1 = ['prompt' => 'Выберите проблемы', 'options' => [$model->device_problems_id=>['selected'=>'selected']]];
?>

<div class="prices-form">

    <?php $form = ActiveForm::begin(); ?>
         <div class="row">
            <?=$form->field($model, 'copy_city',['options'=>['class'=>'col-md-6 form-group']])->DropDownList($items1, $params1)->label('Скопировать');  ?>
            <?=$form->field($model, 'city_id',['options'=>['class'=>'col-md-6 form-group']])->DropDownList($items2, $params2)->label('Куда копировать');  ?>
         </div>

         <?php if($model->isNewRecord): ?>

         <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\AuthItem;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */

// Загрузка роли;
$parent = AuthItem::find()->orderBy('name ASC')->all();
$items = ArrayHelper::map(array_merge($parent),'name','name');
$params = ['prompt' => 'Выберите роли', 'options' => [$model->item_name=>['selected'=>'selected']]];

// Загрузка пользователи;
$parent1 = User::find()->orderBy('id ASC')->all();
$items1 = ArrayHelper::map(array_merge($parent1),'id', 'username');
$params1 = ['prompt' => 'Выберите пользователь', 'options' => [$model->user_id=>['selected'=>'selected']]];

?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'item_name')->DropDownList($items, $params);  ?>

    <?=$form->field($model, 'user_id')->DropDownList($items1, $params1);  ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

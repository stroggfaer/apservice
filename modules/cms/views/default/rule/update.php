<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AuthAssignment */

$this->title = 'Редактировать: '.$model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Управление ролями', 'url' => ['rule']];
$this->params['breadcrumbs'][] = ['label' => $model->item_name, 'url' => ['view-rule', 'item_name' => $model->item_name, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="auth-assignment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

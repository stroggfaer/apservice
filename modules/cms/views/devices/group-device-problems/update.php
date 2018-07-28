<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GroupDeviceProblems */

$this->title = 'Update Group Device Problems: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Group Device Problems', 'url' => ['group-device-problems']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="group-device-problems-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceProblems */

$this->title = 'Редактировать: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Device Problems', 'url' => ['device-problems']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view-device-problems', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="device-problems-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'prices' => $prices,
        'devicesDetails'=>$devicesDetails,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceProblems */

$this->title = 'Редактировать: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Проблемы с устройством', 'url' => ['device-problems']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view-device-problems', 'id' => $model->id]];
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

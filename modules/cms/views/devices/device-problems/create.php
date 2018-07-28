<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DeviceProblems */

$this->title = 'Create Device Problems';
$this->params['breadcrumbs'][] = ['label' => 'Device Problems', 'url' => ['device-problems']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-problems-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'prices' => $prices,
        'devicesDetails'=>$devicesDetails,
    ]) ?>

</div>

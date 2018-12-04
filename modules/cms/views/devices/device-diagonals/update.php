<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceDiagonals */

$this->title = 'Редактировать '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Диагональ устройства', 'url' => ['device-diagonals']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view-device-diagonals', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="device-diagonals-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

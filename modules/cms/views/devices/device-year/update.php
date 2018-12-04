<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceYear */

$this->title = 'Редактировать: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Параметры дивайс', 'url' => ['device-year']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view-device-year', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="device-year-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

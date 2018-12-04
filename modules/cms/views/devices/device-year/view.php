<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceYear */

$this->title = $model->device->title.' ' .$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Параметры дивайс', 'url' => ['device-year']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-year-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update-device-year', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete-device-year', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'device_id',
            'title',
            'status',
        ],
    ]) ?>

</div>

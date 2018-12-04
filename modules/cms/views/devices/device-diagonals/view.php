<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceDiagonals */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Диагональ устройства', 'url' => ['device-diagonals']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-diagonals-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update-device-diagonals', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить диагональ устройства', ['create-device-diagonals'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Удалить', ['delete-device-diagonals', 'id' => $model->id], [
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
            'device_problem_id',
            'title',
            'status',
        ],
    ]) ?>

</div>

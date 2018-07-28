<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GroupDeviceProblems */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Group Device Problems', 'url' => ['group-device-problems']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-device-problems-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create-group-device-problems'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать', ['update-group-device-problems', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete-group-device-problems', 'id' => $model->id], [
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
            'title',
            'position',
            'status',
        ],
    ]) ?>

</div>

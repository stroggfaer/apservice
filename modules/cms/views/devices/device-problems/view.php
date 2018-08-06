<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceProblems */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Device Problems', 'url' => ['device-problems','group_id'=>$model->group_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-problems-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create-device-problems'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать', ['update-device-problems', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete-device-problems', 'id' => $model->id], [
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
            'group_id',
            'title',
            'description:ntext',
            'time',
            'position',
            'status',
        ],
    ]) ?>

</div>

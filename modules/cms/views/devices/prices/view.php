<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Prices */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Цены', 'url' => ['prices']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prices-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update-prices', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete-prices', 'id' => $model->id], [
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
            'city_id',
            'device_problems_id',
            'money',
            'status',
        ],
    ]) ?>

</div>

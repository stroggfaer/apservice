<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Delivery */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Deliveries', 'url' => ['delivery']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update-delivery', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete-delivery', 'id' => $model->id], [
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
            'title',
            'description:ntext',
            'price',
            'status',
        ],
    ]) ?>

</div>

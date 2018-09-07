<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AppleServices */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Apple Сервис', 'url' => ['apple-services']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-services-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update-apple-services', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete-apple-services', 'id' => $model->id], [
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
            'title_seo',
            'address',
            'metro',
            'time',
            'description',
            'map_lat',
            'map_lon',
            'text:ntext',
            'value',
            'status',
        ],
    ]) ?>

</div>

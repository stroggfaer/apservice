<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MenuRepairs */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Меню устройств', 'url' => ['menu-repairs']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-repairs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update-menu-repairs', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete-menu-repairs', 'id' => $model->id], [
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
            'url:url',
            'title',
            'seo_title',
            'seo_description:ntext',
            'position',
            'status',
        ],
    ]) ?>

</div>

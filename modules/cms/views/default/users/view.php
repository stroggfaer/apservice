<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователь', 'url' => ['users']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update-users', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete-users', 'id' => $model->id], [
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
            'username',
            'name',
            'family_name',
            'last_name',
            'phone',
            'email:email',
            [
                'label'     => 'Дата рождения',
                'attribute' => 'birthday',
                'format' =>  ['date', 'php:d.m.Y'],
            ],
            [
                'label'     => 'Дата создания',
                'attribute' => 'created_at',
                'format' =>  ['date', 'php:d.m.Y'],
            ],
            [
                'label'     => 'Дата обновления',
                'attribute' => 'updated_at',
                'format' =>  ['date', 'php:d.m.Y'],
            ],
            'status',
        ],
    ]) ?>
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Редактировать пользователь';
$this->params['breadcrumbs'][] = ['label' => 'Пользователь', 'url' => ['users']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view-users', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

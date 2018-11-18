<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MenuRepairs */

$this->title = 'Редактировать: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Устройства', 'url' => ['menu-repairs']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view-menu-repairs', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="menu-repairs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

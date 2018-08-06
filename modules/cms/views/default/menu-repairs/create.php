<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MenuRepairs */

$this->title = 'Добавить ';
$this->params['breadcrumbs'][] = ['label' => 'Меню устройств', 'url' => ['menu-repairs']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-repairs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

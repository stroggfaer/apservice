<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\sliders */

$this->title = 'Редактировать слайдер: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'sliders', 'url' => ['sliders']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view-sliders', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="sliders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'image' => $image,
    ]) ?>

</div>

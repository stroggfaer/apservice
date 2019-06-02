<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Reviews $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['reviews']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view-reviews', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="reviews-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'images'=>$images
    ]) ?>

</div>

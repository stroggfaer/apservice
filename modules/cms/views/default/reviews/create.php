<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Reviews $model
 */

$this->title = 'Добавить отзыв';
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['reviews']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
        'images'=>$images
    ]) ?>

</div>

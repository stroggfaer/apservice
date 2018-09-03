<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AppleServices */

$this->title = 'Редактировать: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Apple Services', 'url' => ['apple-services']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view-apple-services', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="apple-services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'images' => $images,
    ]) ?>

</div>

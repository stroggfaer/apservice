<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prices */

$this->title = 'Редактировать: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Prices', 'url' => ['prices']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view-prices', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="prices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

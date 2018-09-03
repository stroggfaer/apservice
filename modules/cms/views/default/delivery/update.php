<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Delivery */

$this->title = 'Update Delivery: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Deliveries', 'url' => ['delivery']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view-delivery', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="delivery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

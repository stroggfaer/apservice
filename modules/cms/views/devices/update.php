<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Devices */

$this->title = 'Редактировать: '. $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Девайс', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="devices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'devicesDetails' => $devicesDetails,
    ]) ?>

</div>

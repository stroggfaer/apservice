<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DeviceDiagonals */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Диагональ устройства', 'url' => ['device-diagonals']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-diagonals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

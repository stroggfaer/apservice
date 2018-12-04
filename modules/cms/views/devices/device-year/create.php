<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DeviceYear */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Параметры дивайс', 'url' => ['device-year']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-year-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

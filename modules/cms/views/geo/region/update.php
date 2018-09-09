<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Region */

$this->title = 'Редактировать район:';
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['region']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="region-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GroupDeviceProblems */

$this->title = 'Create Group Device Problems';
$this->params['breadcrumbs'][] = ['label' => 'Group Device Problems', 'url' => ['group-device-problems']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-device-problems-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

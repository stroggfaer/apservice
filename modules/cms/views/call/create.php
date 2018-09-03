<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CallGroups */

$this->title = 'Создать группы';
$this->params['breadcrumbs'][] = ['label' => 'Колл-Центр группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

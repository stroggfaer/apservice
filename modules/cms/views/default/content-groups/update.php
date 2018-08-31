<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContentGroups */

$this->title = 'Редактировать группы контента:'. $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Группы контента', 'url' => ['content-groups']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="content-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

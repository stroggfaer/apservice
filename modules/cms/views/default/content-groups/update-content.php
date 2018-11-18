<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContentGroups */

$this->title = 'Редактировать:'. $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Контент разделов', 'url' => ['content']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="content-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-content', [
        'model' => $model,
    ]) ?>

</div>

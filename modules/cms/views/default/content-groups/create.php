<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ContentGroups */

$this->title = 'Создать группы контента';
$this->params['breadcrumbs'][] = ['label' => 'Группы контента', 'url' => ['content-groups']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

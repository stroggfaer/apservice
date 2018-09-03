<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AppleServices */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Apple Сервис', 'url' => ['apple-services']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

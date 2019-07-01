<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prices */

$this->title = 'Копирование цены';
$this->params['breadcrumbs'][] = ['label' => 'Копирование цены', 'url' => ['prices']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_copy', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sliders*/

$this->title = 'Добавить слайдер';
$this->params['breadcrumbs'][] = ['label' => 'Слайдеры', 'url' => ['sliders']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sliders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'image' => $image,
    ]) ?>

</div>

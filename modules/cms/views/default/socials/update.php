<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Socials */

$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Socials', 'url' => ['socials']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="socials-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

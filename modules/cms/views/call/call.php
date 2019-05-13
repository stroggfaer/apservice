<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;



$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;



?>
<div class="pages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="checkbox-column">
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            $class = ($model->status == 1 ? '' : 'text-danger');
            return [
                'key'   => $key,
                'index' => $index,
                'class' => $class
            ];
        },
        'columns' => [
            'id',
            'date',
            'value',
            'fio',
            'phone',
            'email',
            'comments',
            [
                'label' => 'Статус',
                'format' => 'raw',
                'contentOptions' => ['class'=>'text-center'],
                'value' => function ($model, $index, $widget) {
                    return Html::checkbox('status', $model->status, ['value'=>$index,'class'=>'js-checkbox-column', 'disabled' => false]);
                },
            ],
            [
                'label' => 'Удалить',
                'format' => 'raw',
                'contentOptions' => ['class'=>'text-center'],
                'value' => function ($model, $index, $widget) {
                    return '<a href="#" class="js-call-delete" data-id="'.$model->id.'">Удалить</a>';
                },
            ],

        ],
    ]); ?>
    </div>
</div>

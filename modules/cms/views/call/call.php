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
    <?php Pjax::begin(); ?>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            $class = ($model->status == 1 ? '' : 'danger-com');
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
                'attribute' => 'Статус',
                'format' => 'raw',
                'contentOptions' => ['class'=>'text-center'],
                'value' => function ($model, $index, $widget) {
                    return Html::checkbox('status', $model->status, ['value'=>$index,'class'=>'js-checkbox-column', 'disabled' => false]);
                },
            ],
            [
                'attribute' => 'Удалить',
                'format' => 'raw',
                'contentOptions' => ['class'=>'text-center'],
                'value' => function ($model, $index, $widget) {
                    return '<a href="#" class="js-call-delete" data-id="'.$model->id.'">Удалить</a>';
                },
            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
    </div>
</div>

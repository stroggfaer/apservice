<?php
$this->title = 'CMS Apple Service';

$call = \app\models\Call::find()->where(['status'=>0])->all();
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
?>
<div class="cms-default-index">
    <div class="page-header">
        <h1><?=$this->title?> <small>Панель состояния</small></h1>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            $class = ($model->status == 1 ? '' : 'alert-danger');

            return [
                'key'   => $key,
                'index' => $index,
                'class' => $class
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            [
                'attribute'=>'title',
                'content'   => function ($data) {
                    return '<a href="/cms/call/call?group_id='.$data->id.'">'.$data->title.'</a> ('.$data->callsCounts.')';
                }
            ],
           // 'status',

//            [
//                'class' => 'yii\grid\ActionColumn',
//                'template' => '{update}',
//                'headerOptions' => ['width' => '100'],
//                'urlCreator'=>function($action, $model, $key, $index){
//                    return Url::to([$action,'id'=>$model->id]);
//                }
//
//            ],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\CallGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки группы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-groups-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить группу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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

            'id',
            [
                'attribute'=>'title',
                'content'   => function ($data) {
                    return '<a href="/repair/cms/call/call?group_id='.$data->id.'">'.$data->title.'</a> ('.$data->callsCounts.')';
                }
            ],
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'headerOptions' => ['width' => '100'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action,'id'=>$model->id]);
                }

            ],
        ],
    ]); ?>
</div>

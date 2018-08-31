<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\ContentGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контенты';
$this->params['breadcrumbs'][] = $this->title;

$group_id = Yii::$app->request->get('group_id');

?>
<div class="content-groups-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <p><?= Html::a('Добавить', ['create-content','group_id'=>$group_id], ['class' => 'btn btn-success']) ?></p>


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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'group_id',
                'label'     => 'Группы',
                'content'   => function ($data) {
                    return $data->group->title;
                }
            ],
            'title',
            'title2',
           // 'description',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '100'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action.'-content','id'=>$model->id]);
                }

            ],
        ],
    ]); ?>
</div>

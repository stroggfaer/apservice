<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\PostSearchUsers */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?=  Html::a('Добавить пользователя', ['create-users'], ['class' => 'btn btn-success']) ?></p>
    <?php
    $gridColumns = [
        [
            'label'     => 'ID',
            'attribute' => 'id',
            'options' => ['width' => '50']
        ],

        'username',
        'name',
        'family_name',
        'last_name',
        'phone',
       // 'email:email',
        [
            'label'     => 'Дата рождения',
            'attribute' => 'birthday',
            'format' =>  ['date', 'php:d.m.Y'],
            'options' => ['width' => '100']
        ],

        [
            'label'     => 'Дата регистрация',
            'attribute' => 'created_at',
            'format' =>  ['date', 'php:d.m.Y'],
            'options' => ['width' => '100']
        ],
        [
            'label'     => 'Дата обновления',
            'attribute' => 'updated_at',
            'format' =>  ['date', 'php:d.m.Y'],
            'options' => ['width' => '100']
        ],
        [
            'attribute'=>'type',
            'label'=>' Тип ',
            'vAlign'=>'middle',
            'noWrap'=>true,
            'content'=>function($data){
                $html = '';
                if(!empty($data->type)) {
                    $html .= '<div class="label label-warning" style="display: block; padding:4px 0px">Сотрудник</div>';
                }else {
                    $html .= '<div class="label label-primary" style="display: block padding:4px 0px">Клиент</div>';
                }
                return $html;
            },
        ],
        [
            'class' => 'kartik\grid\BooleanColumn',
            'attribute' => 'status',
            'vAlign' => 'middle'
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}&nbsp;{update}&nbsp;{delete}',
            'options' => ['width' => '150'],
            'urlCreator'=>function($action, $model, $key, $index){
                return Url::to([$action.'-users','id'=>$model->id]);
            }
        ],
    ];
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            $class = ($model->status == 1 ? 'text-success' : 'text-danger');
            return [
                'key'   => $key,
                'index' => $index,
                'class' => $class
            ];
        },

        'responsive'=>false,
        'hover'=>true,
        'columns'=>$gridColumns,
        // 'layout' => $layoutGrid,
        'pjax'=>true,
        'striped'=>false,
        'showPageSummary'=>false,
        'toolbar'=>false,
//        'panel'=>[
//            'type'=>GridView::TYPE_DEFAULT ,
//            'after'=>'{pager}',
//            'footer'=>false,
//        ],
        'persistResize'=>true,
        'responsiveWrap' => false,
    ]); ?>
</div>

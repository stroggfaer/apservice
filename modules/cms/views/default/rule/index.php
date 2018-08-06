<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\AuthAssignmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление ролями';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить', ['create-rule'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,

        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'options' => ['width' => '50']
            ],

            'item_name',
            [
                'attribute'=>'user_id',
                'label'=>'Пользователь',
                'content'   => function ($data) {
                    $html = !empty($data->user->name) && !empty($data->user->family_name) ? $data->user->name.' '.$data->user->family_name.' '.$data->user->last_name : false;
                    return  $html;
                }
            ],
            // 'created_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '80'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action.'-rule','item_name'=>$model->item_name,'user_id'=>$model->user_id]);
                }

            ],
        ],
    ]); ?>
</div>

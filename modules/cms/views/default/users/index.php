<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\PostSearchUsers */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><?=  Html::a('Добавить пользователь', ['create-users'], ['class' => 'btn btn-success']) ?></p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label'     => 'ID',
                'attribute' => 'id',
                'options' => ['width' => '50']
            ],
            [
                'label'     => 'Дата создания',
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
            'username',
            //'email_confirm_token:email',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [
                'label'     => 'Статус',
                'attribute' => 'status',
                'options' => ['width' => '50']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '80'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action.'-users','id'=>$model->id]);
                }
            ],
        ],
    ]); ?>
</div>

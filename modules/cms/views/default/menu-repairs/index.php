<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\MenuRepairSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Меню устройств';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-repairs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create-menu-repairs'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:url',
            'title',
            'seo_title',
            'seo_description:ntext',
            //'position',
            //'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '100'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action.'-menu-repairs','id'=>$model->id]);
                }

            ],
        ],
    ]); ?>
</div>

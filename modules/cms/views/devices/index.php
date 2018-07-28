<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\DevicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Девайсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devices-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'title',
                'label'=>'Девайс',

            ],
            'url:url',
            [
                'attribute'=>'menu_repair_id',
                'content'   => function ($data) {
                    return '<a href="/repair/cms/update-menu-repairs?id='.$data->menuRepair->id.'">'.$data->menuRepair->title.'</a>';
                }
            ],
            //'menu_repair_id',


            'position',
            //'status',


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '100'],
            ],
        ],
    ]); ?>
</div>

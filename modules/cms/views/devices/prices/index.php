<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\PricesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Цены';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prices-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create-prices'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
           // 'city_id',
            [
                'attribute'=>'city_id',
               // 'label'=>'Категорий',
                'content'   => function ($data) {
                    return '<a href="/repair/cms/geo/update-city?id='.$data->city->id.'">'.$data->city->name.'</a>';
                }
            ],
            [
                'attribute'=>'device_problems_id',
                // 'label'=>'Категорий',
                'content'   => function ($data) {
                    return '<a href="/repair/cms/devices/update-device-problems?id='.$data->deviceProblems->id.'">'.$data->deviceProblems->title.'</a>';
                }
            ],
            'money',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '100'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action.'-prices','id'=>$model->id]);
                }

            ],
        ],
    ]); ?>
</div>

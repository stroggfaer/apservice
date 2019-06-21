<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\Functions;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\AppleServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Адреса сервисов';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="apple-services-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить Адреса сервис', ['create-apple-services'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'id',
                'label'=>'Превью',
                'content'   => function ($data) {
                    return'<img style="width: 100px" src="'.$data->img.'?'.rand(6,6).'" />';
                }
            ],
            [
                'attribute' => 'city_id',
                'label'     => 'Город',
                'content'   => function ($data) {
                    if(empty($data->city)) return 'Нет';
                    return '<b>'.$data->city->name.'</b>';
                }
            ],
            'title',
          //  'title_seo',
            'address',
            'metro',
            'time',
            'phone',
            //'description',
            //'map_lat',
            //'map_lon',
            //'text:ntext',
            //'value',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '100'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action.'-apple-services','id'=>$model->id]);
                }
            ],
        ],
    ]); ?>
</div>

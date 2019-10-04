<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\PricesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Цены';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prices-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(Yii::$app->session->hasFlash('error')):?>
        <div class="alert alert-danger"><b> <?= Yii::$app->session->getFlash('error')?></b></div> <!-- For success message -->
    <?php endif; ?>
    <?php if(Yii::$app->session->hasFlash('success')):?>
        <div class="alert alert-success"><b> <?= Yii::$app->session->getFlash('success')?></b></div> <!-- For success message -->
    <?php endif; ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create-prices'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Копирование цены', ['create-copy-prices'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php

    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        [
            'attribute' => 'device_id',
            'filter' => \app\models\Devices::find()->select('title')->indexBy('id')->column(),
            'label'=>'Устройтсва',
            'content'   => function ($data) {
               $device = !empty($data->deviceProblems->devicesDetail->devices->title) ? $data->deviceProblems->devicesDetail->devices->title : 'Нет';
               return $device;
            }
        ],
        [
            'attribute' => 'city_id',
            'format' => 'raw',
            'filter' => \app\models\City::find()->select('name')->indexBy('id')->column(),
            'content'   => function ($data) {
                return '<a href="/cms/geo/update-city?id='.$data->city->id.'">'.$data->city->name.'</a>';
            }
        ],
        [
            'attribute'=>'device_problems_id',
            // 'label'=>'Категорий',
            'content'   => function ($data) {
                return '<a href="/cms/devices/update-device-problems?id='.$data->deviceProblems->id.'">'.$data->deviceProblems->title.'</a>';
            }
        ],
        'money',
        [
            'class' => 'kartik\grid\BooleanColumn',
            'attribute' => 'status',
            'vAlign' => 'middle'
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}&nbsp;{update}&nbsp;{delete}',
            'headerOptions' => ['width' => '100'],
            'urlCreator'=>function($action, $model, $key, $index){
                return Url::to([$action.'-prices','id'=>$model->id]);
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
        'panel'=>[
            'type'=>GridView::TYPE_DEFAULT ,
            'after'=>'{pager}',
            'footer'=>false,
        ],
        'persistResize'=>false,
        'responsiveWrap' => true,
    ]); ?>
</div>

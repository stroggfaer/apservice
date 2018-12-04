<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\DeviceYearSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Параметры дивайс';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-year-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create-device-year'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Добавить диагональ устройства', ['create-device-diagonals'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'device_id',
                'label'=> 'Девайс ID',
                'content'=>function($data){
                    $html = '';
                    $html .= '<a href="/repair/cms/devices/update?id='.$data->device->id.'">'.$data->device->title.'</a>';
                    return $html;
                },
            ],
            'title',
            'value1',
            'value2',
            'title',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '100'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action.'-device-year','id'=>$model->id]);
                }

            ],
        ],
    ]); ?>
</div>

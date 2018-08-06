<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\DeviceProblemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проблемы с устройством';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-problems-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create-device-problems'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'group_id',
                'content'=>function($data){
                    $html = '';
                    $html .= '<a href="/repair/cms/devices/update-group-device-problems?id='.$data->group->id.'">'.$data->group->title.'</a>';
                    return $html;
                },
            ],
            [
                'attribute'=>'',
                'label' => 'Девайс',
                'content'=>function($data){
                   return $data->devices;
                },
            ],
            'title',
            'url',
            'description:ntext',
            'time',
            [
                'attribute'=>'money',
                'label'=>'Цены',
                'content'=>function($data){
                    return $data->price->money;
                },
            ],
            'position',
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '100'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action.'-device-problems','id'=>$model->id]);
                }

            ],
        ],
    ]); ?>
</div>

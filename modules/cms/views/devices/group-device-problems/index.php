<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\GroupDeviceProblemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Проблемы с групповыми устройствами';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-device-problems-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create-group-device-problems'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'title',
                'content'=>function($data){
                    $html = '';
                    $html .= '<a href="/repair/cms/devices/device-problems?group_id='.$data->id.'">'.$data->title.'</a>';
                    return $html;
                },
            ],
            'position',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '100'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action.'-group-device-problems','id'=>$model->id]);
                }

            ],
        ],
    ]); ?>
</div>

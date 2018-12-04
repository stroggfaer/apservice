<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\DeviceDiagonalsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Диагональ устройства';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-diagonals-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create-device-diagonals'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Список параметры', ['device-year'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '100'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action.'-device-diagonals','id'=>$model->id]);
                }

            ],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\SocialsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Социальный кнопки';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socials-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create-socials'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'icon',
            'href',
            'status',
            'position',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '80'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action.'-socials','id'=>$model->id]);
                }

            ],
        ],
    ]); ?>
</div>

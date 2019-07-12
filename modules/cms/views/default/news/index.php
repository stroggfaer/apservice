<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Новости');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить'), ['create-news'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'img',
                'label'=>'Превью',
                'content'   => function ($data) {
                    return'<img style="width: 100px" src="'.$data->images.'?'.rand(6,6).'" />';
                }
            ],

          //  'id',
            'title',
           // 'seo_title',
           // 'keywords',
           // 'description',
            'anons:ntext',
            //'text:ntext',
            [
                'attribute' => 'date_create',
                'format' =>  ['date', 'dd.MM.YYYY'],
                'options' => ['width' => '200']
            ],
            [
                'attribute'=>'type',
                'content'   => function ($data) {
                    return !empty(yii::$app->params['typeNews'][$data->type]) ? yii::$app->params['typeNews'][$data->type] : 'Нет';
                }
            ],
            [
                'attribute'=>'status',
                'content'   => function ($data) {
                    return \app\models\Functions::htmlCheck($data->status);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}&nbsp;{update}&nbsp;{delete}',
                'headerOptions' => ['width' => '80'],
                'urlCreator'=> /**
                 * @param $action
                 * @param $model
                 * @param $key
                 * @param $index
                 * @return mixed
                 */
                    function($action, $model, $key, $index){
                    return Url::to([$action.'-news','id'=>$model->id]);
                }

            ],
        ],
    ]); ?>
</div>

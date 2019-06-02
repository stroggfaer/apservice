<?php
use yii\helpers\Html;
//use yii\grid\GridView;
use app\models\Functions;
use yii\helpers\Url;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\slidersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Слайдеры';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sliders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create-sliders'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $gridColumns = [
        // ['class' => 'yii\grid\SerialColumn'],

        'id',
        [
            'attribute' => 'id',
            'label'     => 'Слайд',
            'format' => ['image',['width'=>'200']],
            'value' => function($data) { return $data->img; },
        ],
        'title',
        'url:url',
        'position',
        //  'exp',
//        'status',
        [
            'class' => 'kartik\grid\BooleanColumn',
            'attribute' => 'status',
            'vAlign' => 'middle'
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}&nbsp;{update}&nbsp;{delete}',
            'headerOptions' => ['width' => '80'],
            'urlCreator'=>function($action, $model, $key, $index){
                return Url::to([$action.'-sliders','id'=>$model->id]);
            }

        ],
    ]
    ?>
    <?php
    $layoutGrid= '<div style="float: right;">{toolbar}</div>
        {summary}
        {items}
        {pager}
        <div class="clearfix"></div>';
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered table-hover ui-sortable',
            'id' => 'sort'
        ],
        'rowOptions'   => function ($model, $key, $index, $grid) {
            $class = 'item';
            $class .= ($model->status == 1 ? '' : ' alert-danger');

            return [
                'key'   => $key,
                'index' => $index,
                'class' => $class,
                'id' => $key
            ];
        },
        'showPageSummary'=>false,
        'responsive'=>false,
        'hover'=>true,
        'layout' => $layoutGrid,
        'columns'=>$gridColumns,
        'pjax'=>true,
        'striped'=>false,
//         parameters from the demo form
        'panel'=>[
            'type'=>GridView::TYPE_DEFAULT ,
            'after'=>'{pager}',
            'footer'=>false,
        ],
        'persistResize'=>false,
        'responsiveWrap' => true
    ]); ?>
</div>

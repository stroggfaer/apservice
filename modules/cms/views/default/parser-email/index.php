<?php

use yii\helpers\Html;
//use yii\grid\GridView;
//use yii\grid\GridView;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\TouchSpin;
use app\models\ParserEmail;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\cms\models\ParserEmailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список Email';
$this->params['breadcrumbs'][] = $this->title;

$mail_login = $exportEmail->getAccountEmail();

// V123
?>
<div class="parser-email-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(!empty($mail_login['email'])): ?>
        <?php

          $call  = $exportEmail->searchMailbox(false,true);
        ?>
        <div class="alert alert-info">
            <span class="text-primary">Яндекс Почта (Входящие) | <b><?php echo($mail_login['email']);?></b></span><br>
            <?php if(true): ?>
            <span class="text-primary">Всего количество писемь <span class="badge"><?=$exportEmail->countsEmail?></span></span><br>
            <span class="text-primary">Всего количество найдено заявки <span class="badge"><?=$call['countsSerach']?></span></span><br>
            <span class="text-primary">Осталось обработать заявки <span class="badge"><?=$call['count']?></span></span><br>
            <?php endif; ?>
        </div>
        <div class="form">
            <h3>Параметры для парсера</h3>
            <form class="form" role="form" method="post">
               <div class="form-group">
                   <div class="row">
                      <div class="col-md-3">
                          <label  class="control-label">Количество выгрузка писемь</label>
                         <?php echo TouchSpin::widget([
                       'name' => 'count_email',
                       'readonly' => true,
                       'pluginOptions' => [
                           'initval' => 1,
                           'min' => 1 ,
                         //  'max' => ($exportEmail->countsEmail),
                       ],
                       'options' => [
                               'id'=>'maxCounts'
                          // 'placeholder' => 'Adjust ...'
                       ],
                   ]); ?>
                      </div>
                       <div class="clear"></div>
                   </div>
               </div>
                <p><?= Html::button('Запустить выгрузка писемь', ['class' => 'btn btn-primary js-run-email-parser']) ?></p>
            </form>
        </div>
    <?php endif; ?>

    <?php
        $gridColumns = [

            ['class' => 'yii\grid\SerialColumn'],
         //   'id',
          //  'uid',
            [
                'attribute'=>'date',
                'label'=>'Дата письмо',
                'width'=>'140px',
                'vAlign'=>'middle',
                'format'=>'datetime', // Возможные варианты: raw, html
                'content'=>function($data){
                    return date('d.m.Y - H:i', strtotime($data->date));
                },
            ],
           // 'subject',
           // 'from_email',
            'name',
            'phone',
            'email:email',
            'city',
           // 'content:ntext',
         //   'create_at',
            //'type',
            //'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'headerOptions' => ['width' => '80'],
                'urlCreator'=>function($action, $model, $key, $index){
                    return Url::to([$action.'-parser-email','id'=>$model->id]);
                }

            ],
        ]
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'   => function ($model, $key, $index, $grid) {
                $class = ($model->status== 1 ? 'text-success' : 'text-danger');
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

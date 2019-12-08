<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\models\DeviceProblems;
/* @var $this yii\web\View */
/* @var $model app\models\Prices */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Подготовка к заливке';
$this->params['breadcrumbs'][] = ['label' => 'Цены', 'url' => ['prices']];
$this->params['breadcrumbs'][] = $this->title;

?>
<h1><?=$this->title?></h1>
<?php
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
        'id',
        'city',
        'devices',
        'device_problems',
        [
            'attribute'=>'description_problems',
            // 'label'=>'Категорий',
            'content'   => function ($data) {
                if(!empty($data->rowPrices['device_problems_id'])) {
                    $deviceProblems = DeviceProblems::find()->where(['id' => $data->rowPrices['device_problems_id']])->one();
                    return $deviceProblems->description;
                } else{
                    return 'no';
                }
            }
        ],
        'prices',
        'status',
        [
            'label' => '',
            'content'   => function ($model) {
                switch ($model->rowPrices['status']) {
                    case 1:
                        $html = '<div class="label label-primary">Обновить запись</div>';
                        break;
                    case 2:
                        $html = '<div class="label label-success">Добавить запись</div>';
                        break;
                    case 3:
                        $html = '<div class="label label-danger">Игнорировать запись</div>';
                        break;
                }

               return $html;
            }
        ],
];
?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,

//    'rowOptions'   => function ($model, $key, $index, $grid) {
//        $class = ($model->status == 1 ? 'text-success' : 'text-danger');
//        return [
//            'key'   => $key,
//            'index' => $index,
//            'class' => $class
//        ];
//    },

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
<?php  $form = ActiveForm::begin([
        'id' => 'download-excel',
        'action' => '/cms/devices/run-prices-excel'
    ]);
?>
     <?= Html::submitButton('Добавить', ['class' => 'btn  btn-success','name'=>'Run', 'value'=>'true',])?>
<?php ActiveForm::end(); ?>
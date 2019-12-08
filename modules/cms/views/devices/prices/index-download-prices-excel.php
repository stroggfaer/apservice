<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\Prices */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Загрузка цены Excel';
$this->params['breadcrumbs'][] = ['label' => 'Цены', 'url' => ['prices']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="index-download-prices-excel">
    <?php if(Yii::$app->session->hasFlash('error')):?>
        <div class="alert alert-danger">
            <h4 class="text-center"><?= Yii::$app->session->getFlash('error')?></h4>
        </div>
    <?php endif; ?>
    <?php  $form = ActiveForm::begin(
        [
            'id'                     => 'download-prices-excel',
//            'enableAjaxValidation'   => true,
//            'enableClientValidation' => true,
//            'validateOnBlur'         => false,
//            'validateOnType'         => false,
//            'validateOnChange'       => false,
//            'validateOnSubmit'       => true,
        ]);  ?>
        <div class="progress-bar-content js-progress-bar-content">
            <div class="alert alert-warning">
                Внимание Во время импорта всегда может пойти что то не так. Поэтому, настоятельно рекомендую делать резервную копию БД перед использованием модуля.<br>
                <a href="/files/prices.xls" download="/files/prices.xls">Скачать шаблон excel</a>
            </div>
            <div class="table">
                <p><b>Пример как заполнить столбец excel</b></p>
                <table class="table table-bordered">
                    <tbody>
                     <tr>
                         <th>Devices*</th>
                         <th>City*</th>
                         <th>Device_problems*</th>
<!--                         <th>Description_problems</th>-->
                         <th>Prices*</th>
                         <th>Status</th>
                     </tr>
                     <tr>
                         <td>iPhone 6</td>
                         <td>Новосибирск</td>
                         <td>Разбито стекло</td>
<!--                         <td>Замена сенсорного экрана дисплея </td>-->
                         <td>3500</td>
                         <td>1</td>
                     </tr>

                    </tbody>

                </table>
                 <span class="small text-muted">*-поле обязательное для заполнения</span>
            </div>
<!--            <div class="progress progress-striped active">-->
<!--                <div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--            </div>-->
            <div class="alert alert-success hidden">
                <b class="text-success">Импорт успешно завершен (<span id="counts_result"></span>)</b>
            </div>
            <div class="alert alert-danger hidden">
                <b class="text-danger">Ошибка что то пошло не так</b>
            </div>
        </div>

        <div class="form-group " style="width: 300px">
            <?= $form->field($model, 'excel')->widget(FileInput::classname(),
                [
                    'options' => ['accept' => 'file/*'],
                    'pluginOptions' => [
                        'allowedFileExtensions' => ['xls', 'xlsx'],
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],

                ])->label('Импортировать файл .xls'); ?>
        </div>
        <?= Html::submitButton(
            'Импорт',
            [
                'class' => 'btn  btn-success',
                'name'=>'Run',
                'value'=>'true',
                /// 'data-confirm' => Yii::t('yii', 'Уверены?'),
            ]
        )?>
    <?php ActiveForm::end(); ?>


</div>

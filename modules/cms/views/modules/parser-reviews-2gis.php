<?php
/**
 * Created by PhpStorm.
 * User: Strogg
 * Date: 07.08.2019
 * Time: 8:30
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->registerJsFile('js/modules/2gis_reviews.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$rating = [5=>'Отличные',4=>'Хорошие',3=>'Средние'];
$apple_services = \app\models\AppleServices::find()->select('title')->indexBy('id')->where(['status'=>1])->andWhere(['not', ['2gis_id' => null]])->orderBy('id ASC')->column();



?>

<div class="parser">
    <div class="panel panel-primary ">
        <div class="panel-heading">Параметры парсер 2gis</div>
        <div class="panel-body">
            Компаний или филиал: <b class="text-success">все</b><br>
            Рейтинг общ: <b class="text-success"><?=$meta['org_rating']?></b><br>
            Количество: <b class="text-success"><?=$meta['org_reviews_count']?></b><br>
        </div>
    </div>
     <?php  $form = ActiveForm::begin(
         [
             'id'                     => 'parser-form-2gis',
             'enableAjaxValidation'   => true,
             'enableClientValidation' => true,
             'validateOnBlur'         => false,
             'validateOnType'         => false,
             'validateOnChange'       => false,
             'validateOnSubmit'       => true,
         ]);  ?>
        <div class="row">
           <?= $form->field($model, 'rating',['options'=>['class'=>'form-group col-md-6']])->DropDownList($rating,['prompt' => 'Все'])->label('Рейтинг') ?>
           <?= $form->field($model, 'apple_services',['options'=>['class'=>'form-group col-md-6']])->DropDownList($apple_services,['prompt' => 'Все'])->label('Эпел сервис') ?>
        </div>

        <div class="progress-bar-content js-progress-bar-content">
                <div class="counts"><b><?=$meta['org_reviews_count']?> из <span id="counters">0</span></b></div>
                <div class="progress progress-striped active">
                    <div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="alert alert-success hidden">
                    <b class="text-success">Импорт успешно завершен (<span id="counts_result"></span>)</b>
                </div>
                <div class="alert alert-danger hidden">
                    <b class="text-danger">Ошибка что то пошло не так</b>
                </div>
        </div>

        <div class="form-group ">
            <?= Html::button('Импортировать',['class' => 'btn btn-success js-2gis-run']) ?>
        </div>
     <?php ActiveForm::end(); ?>
    <div class="list-reviews">

    </div>

</div>


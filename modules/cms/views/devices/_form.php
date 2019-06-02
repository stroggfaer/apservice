<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\Devices */
/* @var $form yii\widgets\ActiveForm */

// Загрузка пользователи;
$parent = \app\models\MenuRepairs::find()->orderBy('id ASC')->all();
$items = ArrayHelper::map(array_merge($parent),'id', 'title');
$params = ['prompt' => 'Выберите устройства', 'options' => [$model->menu_repair_id=>['selected'=>'selected']]];

$deviceProblems = $model->deviceProblemsArrayList;

?>

<div class="devices-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'menu_repair_id')->DropDownList($items, $params);  ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint('Только латинские буквы и цифры. Можно не заполнять.') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true])->hint('Шаблонизатор {city} - Город'); ?>
    <?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => true])->hint('Шаблонизатор {city} - Город')  ?>
    <?= $form->field($model, 'seo_description')->textarea(['row' => 2])->hint('Шаблонизатор {city} - Город')  ?>


     <?php if(!empty($model->deviceProblemsArrayList) && !empty($devicesDetails)): ?>
        <?= $form->field($devicesDetails, 'devices_id')->widget(Select2::classname(), [
            'data' =>  $model->deviceProblemsArrayList,
            'maintainOrder' => true,
            'options' => ['placeholder' => 'Введите список проблемы ...', 'multiple' => true],
            'pluginOptions' => [
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 30
            ],
        ])->label('Добавить проблемы'); ?>
    <?php endif; ?>

    <?= $form->field($model, 'checkbox_copy')->checkbox(['disabled' => false,]) ?>
    <?php if(true && !empty($model->devicesDetails)): ?>
        <div class="table__com">
            <div class="content">
                <table class="table table-bordered table-hover">
                    <tr class="info">
                        <th>Список проблемы</th>
                        <th width="50px">Убрать</th>
                    </tr>
                       <?php foreach ($model->devicesDetails as $devicesDetails): ?>
                         <tr class="item">
                             <td><a href="/cms/devices/update-device-problems?id=<?=$devicesDetails->deviceProblems->id?>" target="_blank"><?=$devicesDetails->deviceProblems->title?></a></td>
                             <td><button type="button" class="close js-device-problems-delete" data-dismiss="alert" data-id="<?=$devicesDetails->id?>" aria-hidden="true">×</button></td>
                         </tr>
                       <?php endforeach; ?>

                </table>
            </div>
            <?php if(count($model->devicesDetails) >= 5): ?>
               <div class="text-center more"> <a href="#" onclick="return table_all();">Загрузить все</a></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

   <div class="alert alert-info">
       <h3>Параметры для SEO</h3>
       <?= $form->field($model, 'title_h1')->textInput(['maxlength' => true])->hint('Шаблонизатор {device} - Девайс {city} - Город'); ?>
       <?= $form->field($model, 'title_h3')->textInput(['maxlength' => true])->hint('Шаблонизатор {device} - Девайс {city} - Город'); ?>
       <?= $form->field($model, 'text')->widget(CKEditor::className(), [
           'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
               'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
               'inline' => false, //по умолчанию false
           ]),

           'options' => ['rows' => 3],


       ])->label('Текст')->hint('Шаблонизатор {city} - Город, {device} - Девайс');  ?>
   </div>


    <?php if($model->isNewRecord): ?>
        <?php $position = \app\models\Devices::find()->select('position')->where(['status'=>1])->orderBy('id DESC')->one();
        $positionValue =  !empty($position) ? $position->position + 1 : 1 ?>
        <?= $form->field($model, 'position')->textInput(['value'=>$positionValue]) ?>
    <?php else: ?>
        <?= $form->field($model, 'position')->textInput() ?>
    <?php endif; ?>

    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

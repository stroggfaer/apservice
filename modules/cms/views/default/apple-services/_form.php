<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\widgets\FileInput;
use app\models\Functions;
/* @var $this yii\web\View */
/* @var $model app\models\AppleServices */
/* @var $form yii\widgets\ActiveForm */

$city = ArrayHelper::map(array_merge(\app\models\City::find()->orderBy('id ASC')->all()),'id', 'name');
$params = ['prompt' => 'Выберите город', 'options' => [$model->city_id=>['selected'=>'selected']]];

?>

<div class="apple-services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'city_id')->DropDownList($city, $params);  ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint('Только латинские буквы и цифры. Можно не заполнять.') ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_seo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>
    <div class="row">
      <?= $form->field($model, 'map_lat',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>
      <?= $form->field($model, 'map_lon',['options'=>['class'=>'form-group col-sm-6']])->textInput(['maxlength' => true]) ?>
    </div>
    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ]),

        'options' => ['rows' => 6],


    ])->label('Текст');  ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>


    <?php  if(!$model->isNewRecord): ?>
        <div class="images form-content-images">
            <?php
             $img = Functions::imgPath('/apple/'.$model->id.'.png');
             $pathFile = Functions::pathFile('/apple/').$model->id.'.png';
             echo !empty($img) ?'<img style="width: 100px" class="js-delete-image-file" data-path="'.$pathFile.'" src="'.$img.'?'.rand(6,6).'" />' : 'Нет фото';
            ?>
        </div>
        <?= $form->field($images, 'imageMax')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
                'multiple' => true
            ],
        ])->label('Загрузить Обложка 210x210 формат png'); ?>
    <?php endif; ?>


    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

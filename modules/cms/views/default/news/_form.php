<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use kartik\widgets\FileInput;
use \kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
$newsType = Yii::$app->params['typeNews'];
$params = ['prompt' => 'Выберите тип новости', 'options' => [$model->type=>['selected'=>'selected']]];

$city = \app\models\City::find()->select('name')->indexBy('id')->orderBy('id ASC')->column();
$params_city = ['prompt' => 'Выберите город', 'options' => [$model->city_id=>['selected'=>'selected']]];


?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'city_id')->DropDownList($city, $params_city)->hint('В каком городе показывать новости по умол. для всех видно') ?>

    <?=$form->field($model, 'type')->DropDownList($newsType, $params) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint('Только латинские буквы и цифры. Можно не заполнять.') ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true])->hint('Шаблонизатор {city} - Город');  ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true])->hint('Шаблонизатор {city} - Город');  ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4])->hint('Шаблонизатор {city} - Город');  ?>

    <?= $form->field($model, 'anons')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ]),

        'options' => ['rows' => 6],


    ])->label('Текст');  ?>
    <?= $form->field($model, 'date_create')->widget(DateControl::classname(), [
        'type'=>DateControl::FORMAT_DATE,
        'ajaxConversion'=>false,
        'value'=>date('Y-m-d'),
        'widgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]
    ])?>
    <div class="images form-content-images">
        <?php if($model->isImg && !$model->isNewRecord ): ?>
            <i class="glyphicon glyphicon-remove js-delete-image-file" data-file-name="news/<?=$model->id.'.'.$model->ext?>" data-file-min="news/<?=$model->id.'_min.'.$model->ext?>" ></i>
            <?php echo '<img style="width: 100px" class="" src="'.$model->images.'?'.time().'" />'; ?>
        <?php endif; ?>
    </div>

    <?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
        ],
    ])?>
    <?= $form->field($model, 'show')->checkbox(['disabled' => false,]) ?>
    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

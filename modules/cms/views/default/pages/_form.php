<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use yii\helpers\ArrayHelper;
use app\models\Pages;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */
/* @var $form yii\widgets\ActiveForm */
$menuType = [
    0 =>'Не выводить',
    1 =>'Меню в шапке',
    2 =>'Меню в футере',
    3 =>'Меню в Top',
];
$params = ['prompt' => 'Выберите позицию меню', 'options' => [$model->menu=>['selected'=>'selected']]];
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true])->hint('Шаблонизатор {city} - Город');  ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true])->hint('Шаблонизатор {city} - Город');  ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->hint('Шаблонизатор {city} - Город');  ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ]),

        'options' => ['rows' => 6],


    ])->label('Текст');  ?>

    <?php if($model->isNewRecord): ?>
        <?php $position = Pages::find()->select('position')->where(['status'=>1])->orderBy('id DESC')->one(); ?>
        <?= $form->field($model, 'position')->textInput(['value'=>$position->position + 1]) ?>
    <?php else: ?>
        <?= $form->field($model, 'position')->textInput() ?>
    <?php endif; ?>

    <?=$form->field($model, 'menu')->DropDownList($menuType, $params)->label('Тип меню');  ?>
  
    <?= $form->field($model, 'content')->checkbox(['disabled' => false,]) ?>
    <?= $form->field($model, 'footer')->checkbox(['disabled' => false,]) ?>

    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

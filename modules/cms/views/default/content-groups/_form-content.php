<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\ContentGroups */
/* @var $form yii\widgets\ActiveForm */
$contentGroups = ArrayHelper::map(array_merge(\app\models\ContentGroups::find()->where(['status'=>1])->orderBy('id ASC')->all()),'id','title');

$params = ['prompt' => 'Выберите Группы', 'options' => [$model->group_id=>['selected'=>'selected']]];

$group_id = Yii::$app->request->get('group_id');

?>

<div class="content-groups-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if(!empty($group_id)): ?>
        <?= $form->field($model, 'group_id')->hiddenInput(['maxlength' => true,'value'=>$group_id])->label(false) ?>
    <?php else: ?>
        <?= $form->field($model, 'group_id')->DropDownList($contentGroups, $params)->label('Группы');  ?>
    <?php endif; ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->
    hint('
         Группа: Ремонт Шаблонизатор {city} - Город, {repair} - Ремонт,<br>
         Группа: Девайс Шаблонизатор {city} - Город, {device} - Девайс<br>
         Группа: Проблемы Шаблонизатор {city} - Город, {device} - Девайс {device_problems} - Проблемы<br>'
    )->label('Заголовок H3') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->hint('
         Группа: Ремонт Шаблонизатор {city} - Город, {repair} - Ремонт,<br>
         Группа: Девайс Шаблонизатор {city} - Город, {device} - Девайс<br>
         Группа: Проблемы Шаблонизатор {city} - Город, {device} - Девайс {device_problems} - Проблемы<br>'
    ) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ]),

        'options' => ['rows' => 6],


    ])->label('Текст')->hint('
         Группа: Ремонт Шаблонизатор {city} - Город, {repair} - Ремонт,<br>
         Группа: Девайс Шаблонизатор {city} - Город, {device} - Девайс<br>
         Группа: Проблемы Шаблонизатор {city} - Город, {device} - Девайс {device_problems} - Проблемы<br>'
    ) ?>

    <?= $form->field($model, 'title2')->textInput(['maxlength' => true])-> hint('
         Группа: Ремонт Шаблонизатор {city} - Город, {repair} - Ремонт,<br>
         Группа: Девайс Шаблонизатор {city} - Город, {device} - Девайс<br>
         Группа: Проблемы Шаблонизатор {city} - Город, {device} - Девайс {device_problems} - Проблемы<br>'
    )->label('Заголовок H3')  ?>

    <?= $form->field($model, 'text2')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ]),

        'options' => ['rows' => 6],


    ])->label('Текст2')->hint('
         Группа: Ремонт Шаблонизатор {city} - Город, {repair} - Ремонт,<br>
         Группа: Девайс Шаблонизатор {city} - Город, {device} - Девайс<br>
         Группа: Проблемы Шаблонизатор {city} - Город, {device} - Девайс {device_problems} - Проблемы<br>'
    ) ?>
    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

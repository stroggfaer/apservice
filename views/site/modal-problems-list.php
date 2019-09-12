<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


$group_id  = Yii::$app->request->post('group_id');
$callGroups = \app\models\CallGroups::find()->where(['id'=>$group_id])->one();
$model = new \app\models\Repair();
$devicesClass = new \app\models\Devices();

// Параметры пост данные;
$repair_id = Yii::$app->request->post('repair_id');
$device_id = Yii::$app->request->post('device_id');
$problem_id = Yii::$app->request->post('problem_id');

// Записываем параметры;
$model->setMenuRepair($repair_id);

//print_arr($repair_id.'---'.$device_id.'----'.$problem_id);

$deviceProblems = !empty($model->getSelectCurrentRepair()->devices) ? $model->getSelectCurrentRepair()->devices : null;

// устройство;
$repairs = ArrayHelper::map(array_merge($model->getMenuRepairs()),'id','title');
$params = ['prompt' => 'Укажите устройство','class'=>'form-control select js-call-select-form-repair',['options' => [$call->repair=>['selected'=>'selected']]] ];
//['options' => [2 => ['disabled' => true]]]
// Модель;
if(!empty($model->getSelectCurrentRepair()->devices)) {
    $call->devices = $device_id;
    $params2 = ['class' => 'form-control select js-call-select-form-devices','data-repair-id'=>$model->getSelectCurrentRepair()->id,['options' => [$call->devices=>['selected'=>'selected']]]];
    $devices = ArrayHelper::map(array_merge($model->getSelectCurrentRepair()->devices), 'id', 'title');
}else{
    $params2 = ['prompt' => '---', 'class' => 'form-control select','disabled' => true];
    $devices = [];
}

// Проблемы;
if(!empty($model->getSelectCurrentRepair()->devices[0]->deviceProblemsList)) {
    $call->problems = $problem_id;

    $devicesOne = !empty($device_id) ? $devicesClass->getDevice($device_id) :$model->getSelectCurrentRepair()->devices[0];

    $deviceProblems = ArrayHelper::map(array_merge($devicesOne->deviceProblemsList), 'id', 'title');
    if(!empty($devicesOne->deviceProblemsList)) {
        $params3 = ['class' => 'form-control select js-call-select-form-problems-list', 'data-device-id' => $devicesOne->id, 'data-repair-id' => '', ['options' => [$call->problems => ['selected' => 'selected']]]];
    }else{
        $params3 = ['prompt' => 'Нет данных', 'class' => 'form-control select','disabled' => true];
        $deviceProblems = [];
    }
}else{
    $params3 = ['prompt' => '---', 'class' => 'form-control select','disabled' => true];
    $deviceProblems = [];
}
 ?>
<div class="alert alert-success alert__js hidden text-center">
    <b class="name"></b>
</div>
<div class="call-form">

        <?php if(!empty($callGroups->description)): ?>
            <div class="description"><?=$callGroups->description?></div>
        <?php endif; ?>
        <!--Форма-->
        <?php $form = ActiveForm::begin([
            'options' => ['class' => 'form__mod js-form-ajax'],
            'enableAjaxValidation'   => true,
            'enableClientValidation' => true,
            'validateOnBlur'         => false,
            'validateOnType'         => false,
            'validateOnChange'       => false,
            'validateOnSubmit'       => true,
        ]); ?>
        <div class="row">
           <div class="col-sm-6">
            <div class="small">* Обязательные поля</div>
               <?= $form->field($call, 'fio')->textInput(['placeholder' => 'Имя*'])->label(false) ?>
               <?= $form->field($call, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '+7 (999)-999-9999',])->textInput(['placeholder' => 'Телефон*'])->label(false);?>
           </div>
            <div class="col-sm-6">
                <div class="small">Предварительная диагностика</div>
                <?=$form->field($call, 'repair',['options'=>['class'=>'form-group select__mod']])->DropDownList($repairs, $params)->label(false);  ?>
                <div class="content_update">
                    <?php $classDisabled = !empty($devices) ? '' : 'disabled' ?>
                    <?=$form->field($call, 'devices',['options'=>['class'=>'form-group select__mod '.$classDisabled]])->DropDownList($devices, $params2)->label(false);  ?>
                    <?=$form->field($call, 'problems',['options'=>['class'=>'form-group select__mod '.$classDisabled]])->DropDownList($deviceProblems, $params3)->label(false);  ?>

                    <?php
                    reset($deviceProblems);
                    $device_problems_id = key($deviceProblems);
                    ?>
                    <div class="content_result">
                        <?= \app\components\modal\WContentProblemsList::widget(['repair'=>$model,'device_problems_id'=>$device_problems_id])?>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="group_id" value="<?=$group_id?>">
        <input type="hidden" name="call_form" value="true">
        <div class="form-group text-center"><button class="btn btn-red circle loading js-send-call" id="ya_send_<?=$group_id?>" disabled="disabled" type="submit">Отправить</button></div>
        <?php ActiveForm::end(); ?> <!--./Форма-->
</div>

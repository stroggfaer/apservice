<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\DeviceYear */
/* @var $form yii\widgets\ActiveForm */
$devices = \app\models\Devices::find()->select(['title','id'])->where(['status'=>1])->orderBy('id ASC')->indexBy('id')->asArray()->column();
$params = ['prompt' => 'Выберите девайс', 'options' => [$model->device_id=>['selected'=>'selected']]];
?>
<!--Modal Оплата-->
<?php Modal::begin(['header' => '<h4>Добавить диагональ</h4>',
    'closeButton' => ['tag' => 'button', 'label' => '&times;'],
    'id' => 'window-modal-add-diagonal',
    // 'size'=>'modal-sm',
]);?>
<?php Modal::end(); ?>


<div class="device-year-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=$form->field($model, 'device_id')->DropDownList($devices, $params);  ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if(!$model->isNewRecord ): ?>
        <div class="form-group"><button class="btn-success btn js-add-diagonal" type="button" data-toggle="modal" data-target="#window-modal-add-diagonal" data-device-year-id="<?=$model->id?>">Добавить диагональ </button></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <tr>
            <td><?= $form->field($model, 'title_th1')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'value1')->textInput(['maxlength' => true]) ?></td>
        </tr>
        <tr>
            <td><?= $form->field($model, 'title_th2')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($model, 'value2')->textInput(['maxlength' => true]) ?></td>
        </tr>
    </table>

    <?= $form->field($model, 'status')->checkbox(['disabled' => false,]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

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
<?php Modal::begin(['header' => '<h4>Добавить список проблемы</h4>',
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
        <div class="form-group"><button class="btn-success btn js-add-diagonal" type="button" data-toggle="modal" data-target="#window-modal-add-diagonal" data-device-id="<?=$model->device_id?>" data-device-year-id="<?=$model->id?>">Добавить список проблемы </button></div>

        <?php

        // print_arr($model->deviceDiagonals);
        ?>
        <?php if(!empty($model->deviceDiagonals)): ?>
            <table class="table table-bordered">
                <tr>
                    <th>Диагональ</th> <th>Действия</th>
                </tr>
                <?php foreach ($model->deviceDiagonals as $deviceDiagonal):?>
                <tr>
                    <td>
                        <div class="form-group"><b><?= $deviceDiagonal->title ?></b></div>
                        <?php if(!empty($deviceDiagonal->diagonalDeviceProblems)): ?>
                            <div style="max-height: 200px; overflow: auto;">
                               <table class="table table-bordered table-hover table-striped" >
                                <tr>
                                    <th>Список проблемы</th>
                                    <th>Цена</th>
                                    <th>Действия</th>
                                </tr>
                                <?php foreach ($deviceDiagonal->getDiagonalDeviceProblems($model->id) as $diagonalDeviceProblem):?>
                                 <tr>
                                     <td><?=$diagonalDeviceProblem->title?></td>
                                     <td><?=\app\models\Functions::money($diagonalDeviceProblem->price->money)?> р.</td>
                                     <td>
                                         <?= Html::a('Удалить', ['delete-device-year-details', 'id' => $diagonalDeviceProblem->deviceYearDetail->id,'device_year_id' => $model->id], [
                                             'class' => '',
                                             'data' => [
                                                 'confirm' => 'Вы точно хотите удалить?',
                                                 'method' => 'post',
                                             ],
                                         ]) ?>
                                     </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?= Html::a('Удалить', ['delete-device-year-details','id'=>0, 'device_year_id' => $model->id,'diagonal_id' => $deviceDiagonal->id], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Вы точно хотите удалить?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
        <?php endif ?>
        <?php if(!empty($model->deviceProblems)): ?>

            <h3>Список проблемы</h3>
            <div style="max-height: 200px; overflow: auto;">
                <table class="table table-bordered table-hover table-striped" >
                    <tr>
                        <th>Список проблемы</th>
                        <th>Цена</th>
                        <th>Действия</th>
                    </tr>
                    <?php foreach ($model->getDeviceProblems() as $diagonalDeviceProblem): ?>

                        <tr>
                            <td><?=$diagonalDeviceProblem->title?></td>
                            <td><?=\app\models\Functions::money($diagonalDeviceProblem->price->money)?> р.</td>
                            <td>
                                <?= Html::a('Удалить', ['delete-device-year-details', 'id' => $diagonalDeviceProblem->deviceYearDetail->id,'device_year_id' => $model->id], [
                                    'class' => '',
                                    'data' => [
                                        'confirm' => 'Вы точно хотите удалить?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <h3>Дополнительные столбцы</h3>
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

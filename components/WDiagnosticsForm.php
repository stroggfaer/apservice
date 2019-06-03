<?php
namespace app\components;
use app\models\Devices;
use app\models\Functions;
use app\models\Repair;
use yii\base\Widget;
use Yii;

class WDiagnosticsForm extends Widget{

    public $model;

    public function init() {
        parent::init();

        if ($this->model === null) {
            $this->model = false;
        }

    }
    public function run(){

        $repair =  new Repair();
        $devices = new Devices();
        $city = \Yii::$app->action->currentCity;

            ?>
             <div class="diagnostics">
                <div class="text-left">
                    <h2 class="seo-title">Предварительная диагностика</h2>
                    <div style="position: relative;left: 5px; display: none">Узнай  срок и цену ремонта за одну минут</div>
                </div>
                <div class="form">
                    <form role="form" class="form__mod">
                        <div class="row">
                            <div class="form-group col-md-6 col-xs-6 ">
                                <label>Укажите устройство</label>
                                <div class="select__mod"><select  class="select form-control js-select-devices-form ">
                                    <option>---</option>
                                    <?php if(!empty($repair->devices)): ?>
                                        <?php foreach ($repair->devices as $device): ?>
                                             <?php
                                                $selected = (!empty($repair->deviceObj->deviceOne) && $repair->deviceObj->deviceOne->id == $device->id ? 'selected' : !empty($this->model->device->id) && $this->model->device->id == $device->id ? 'selected' : '');
                                              ?>
                                             <option <?=$selected?> value="<?=$device->id?>"><?=$device->title?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select></div>
                            </div>
                            <?php
                             /*TODO доделать по умол выбираем 1*/
                            $deviceProblems = !empty($this->model->device) ? $devices->getDeviceProblems($this->model->device): (!empty($repair->deviceObj->deviceOneProblems) ? $repair->deviceObj->deviceOneProblems : false);
                            ?>
                            <div class="form-group col-md-6 col-xs-6 update-select__js">
                                <label>Укажите проблему</label>
                                <div class="select__mod"> <select class="select form-control js-select-devices-problems-form" <?=!empty($deviceProblems) ? '' : 'disabled'?>>
                                    <option>---</option>
                                    <?php if(!empty($deviceProblems)):?>
                                        <?php foreach ($deviceProblems as $deviceOneProblem): ?>
                                            <?php
                                            $selected_2 = (!empty($devices->deviceProblemOne) && $devices->deviceProblemOne->id == $deviceOneProblem->id ? 'selected' : '')
                                            ?>
                                            <option <?=$selected_2?> value="<?=$deviceOneProblem->id?>"><?=$deviceOneProblem->title?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select></div>
                            </div>
                        </div>
                    </form>
                </div>
                 <div class="update-content__js pull-left diagnostic-result">
                     <?php if(!empty($repair->deviceObj->deviceProblemOne)): ?>
                         <div class="title"><?=$repair->deviceObj->deviceProblemOne->title?></div>
                         <div class="description"><?=$repair->deviceObj->deviceProblemOne->description?></div>
                     <?php endif; ?>
                 </div>
                 <div class="result-content result-content__js pull-right ">
                    <?php if(!empty($repair->deviceObj->deviceProblemOne)): ?>
                        <div class="content">
                            <div class="icon-clock time"><span class="i"><?=$repair->deviceObj->deviceProblemOne->time?></span></div>
                            <div class="icon-wallet money"><span class="i"><?=Functions::money($repair->deviceObj->deviceProblemOne->price->money)?> <span class="rub">р.</span></span></div>
                        </div>
                    <?php endif; ?>
                </div>
                 <div class="clear"></div>
                 <div class="description-warning">
                     Внимание! Данная информация является ознакомительной и не гарантирует, что результаты “Предварительной диагностики” могут совпадать с диагностикой вашего устройства в сервисном центре.
                 </div>
                <div class="clear"></div>
            </div>
            <?php
    }
}
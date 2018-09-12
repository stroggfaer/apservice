<?php
namespace app\components;

use app\models\Clients;
use app\models\Devices;
use app\models\fitness\UserFitness;
use app\models\Functions;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii;

class WDevicesProblemsList extends Widget{
    public $model;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
    }
    public function run(){
        $request = Yii::$app->request;
        $id = abs($request->post('id'));

        $devices = new Devices();
        $devicesAll = $devices->getDevices();
        $city =  \Yii::$app->action->currentCity;
        $device = $devices->getDevice($id);
        $deviceProblems = $devices->getDeviceProblems($device)



        ?>



            <div class="devices-problems-list">
                <div class="text-center title-main"><h2>Выберите ваше устройство</h2></div>
                <div class="devices__menu devices_carusel desktop">
                    <div class="content__load"><div></div></div>
                    <div class="items">
                        <?php foreach ($devicesAll as $key => $value): ?>
                            <div class="item <?=$device->id == $value->id ? 'active' : ''?>  js-select-devices"  data-id="<?=$value->id?>"><a href="#"><?=$value->title?></a></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="select__mod mobile">
                    <select class="select js-select-devices">
                        <?php foreach ($devicesAll as $key => $value): ?>
                           <option <?=$device->id == $value->id ? 'selected' : ''?>   data-id="<?=$value->id?>"><?=$value->title?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="table update_table_content">
                    <table class="table">
                        <tr>
                            <th class="name1">Услуги по ремонту <?=$devicesAll[0]->title?></th>
                            <th class="text-right name2">Цена выезде</th>
                            <th class="text-right name3">Цена в сервисных центрах</th>
                        </tr>
                        <?php if(!empty($deviceProblems)): ?>
                            <?php foreach ($deviceProblems as $deviceProblem): ?>
                                <tr>
                                    <td><a href="<?=$devices->device->menuRepair->url?>/<?=$devices->device->url?>/<?=$deviceProblem->url?>"><?=$deviceProblem->title?></a></td>
                                    <td class="text-right"><?=Functions::money($city->deliverie->price)?> руб</td>
                                    <td class="text-right"><?=$deviceProblem->value?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </table>
                    <a href="#" class="dotted">Еще услуги</a>
                </div>
            </div>
            <?php
        }

}
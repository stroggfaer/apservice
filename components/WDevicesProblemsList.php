<?php
namespace app\components;

use app\models\Clients;
use app\models\Devices;
use app\models\fitness\UserFitness;
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

        $devices = new Devices();
        $devicesAll = $devices->getDevices();
            ?>



            <div class="devices-problems-list">
                <div class="text-center title-main"><h2>Выберите ваше устройство</h2></div>
                <div class="devices__menu devices_carusel desktop">
                    <div class="items">
                        <?php foreach ($devicesAll as $key => $value): ?>
                            <div class="item <?=$key == 0 ? 'active' : ''?>"  data-id="<?=$value->id?>"><a href="#"><?=$value->title?></a></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="select__mod mobile">
                    <select class="select">
                        <?php foreach ($devicesAll as $key => $value): ?>
                           <option <?=$key == 0 ? 'selected' : ''?> data-id="<?=$value->id?>"><?=$value->title?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="table">
                    <table class="table">
                        <tr>
                            <th class="name1">Услуги по ремонту iPhone 6S</th>
                            <th class="text-right name2">Цена выезде</th>
                            <th class="text-right name3">Цена в сервисных центрах</th>
                        </tr>
                        <?php foreach ($devices->deviceProblems as $deviceProblem): ?>
                            <tr>
                                <td><a href="<?=$devices->device->menuRepair->url?>/<?=$devices->device->url?>/<?=$deviceProblem->url?>"><?=$deviceProblem->title?></a></td>
                                <td class="text-right">2 350 руб</td>
                                <td class="text-right"><?=$deviceProblem->value?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <a href="#" class="dotted">Еще услуги</a>
                </div>
            </div>
            <?php
        }

}
<?php
namespace app\components;
use app\models\Devices;
use app\models\Functions;
use yii\base\Widget;
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
        $limit = abs($request->post('limit'));
        if(empty($this->model))  return false;

        $devices = new Devices();

        $devicesAll =  $this->model->devices;  //$devices->getDevices();
        $city =  \Yii::$app->action->currentCity;
        $device = !empty($id)?  $devices->getDevice($id)  : $devicesAll[0];

        if(!empty($limit)) $devices->setLimit($limit);
        $deviceProblems = $devices->getDeviceProblems($device);
        $countsLimit = $devices->getCountsLimit($device);


        if(empty($devicesAll)) return false;
        ?>

            <div class="devices-problems-list">
                <div class="text-center title-main"><div class="seo-title">Выберите ваше устройство</div></div>
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
                           <option <?=$device->id == $value->id ? 'selected' : ''?> value="<?=$value->id?>" ><?=$value->title?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="table update_table_content">
                    <table class="table">
                        <tr class="header">
                            <th class="name1">Услуги по ремонту <?=$device->title?></th>
<!--                            <th class="text-right name2">Цена выезде</th>-->
                            <th class="text-right name3">Цена</th>
                        </tr>
                        <?php if(!empty($deviceProblems)): ?>
                            <?php foreach ($deviceProblems as $deviceProblem): ?>
                                <tr class="list">
                                    <td><a href="/repair/<?=$device->menuRepair->url?>/<?=$device->url?>/<?=$deviceProblem->url?>"><?=$deviceProblem->title?></a></td>
                                    <?php if(false):?>
                                       <td class="text-right"><?=Functions::money($city->deliverie->price)?> руб</td>
                                    <?php endif; ?>
                                    <td class="text-right"><?=$deviceProblem->value?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </table>
                    <?php if(!empty($countsLimit['counts'])): ?>
                      <a href="#" class="dotted js-limit-devices-problems-table more" data-device-id="<?=$device->id?>" data-counts="<?=$countsLimit['counts']?>"  data-limit="<?=$countsLimit['limit']?>">Еще услуги</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }

}
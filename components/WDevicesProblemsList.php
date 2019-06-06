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
        $id = !empty(abs($request->post('id'))) ? $request->post('id') : (!empty($this->model->device->id) ? $this->model->device->id : null);
        $limit = abs($request->post('limit'));
        if(empty($this->model))  return false;

        $devices = new Devices();

        $devicesAll =  $this->model->devices;  //$devices->getDevices();
        $city =  \Yii::$app->action->currentCity;

        $device = !empty($id) ?  $devices->getDevice($id)  : $devicesAll[0];

        if(!empty($limit)) $devices->setLimit($limit);
        $deviceProblems = $devices->getDeviceProblems($device);
        $countsLimit = $devices->getCountsLimit($device);


        if(empty($devicesAll)) return false;
        ?>

            <div class="devices-problems-list">
                <div class="text-center title-main hidden"><div class="seo-title">Выберите ваше устройство</div></div>
                <div class="devices__menu devices_carusel desktop">
                    <div class="content__load"><div></div></div>
                    <div class="items" data-counts="<?=count($devicesAll)?>">
                        <?php foreach ($devicesAll as $key => $value): ?>
                            <div class="item <?=$device->id == $value->id ? 'active' : ''?>  js-select-devices "  data-id="<?=$value->id?>" data-action=""><a href="#" title="<?=$value->title?>"><?=Functions::strResize($value->title)?></a></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="label-text mobile">Выберите модель устройства</div>
                <div class="select__mod mobile">
                    <select class="select js-select-devices">
                        <?php foreach ($devicesAll as $key => $value): ?>
                           <option <?=$device->id == $value->id ? 'selected' : ''?> value="<?=$value->id?>" ><?=$value->title?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="update_table_content block-table">
                    <div class="list-items">
                        <?php if(!empty($deviceProblems)): ?>
                            <?php foreach ($deviceProblems as $deviceProblem): ?>
                                <div class="list">
                                    <div class="content">
                                        <div class="name"><a href="/repair/<?=$device->menuRepair->url?>/<?=$device->url?>/<?=$deviceProblem->url?>"><?=$deviceProblem->title?></a></div>
                                        <?php if(false):?>
                                           <div class="text-right price"><?=Functions::money($city->deliverie->price)?> <span class="rub">р.</span></div>
                                        <?php endif; ?>
                                        <div class="text-right value"><?=$deviceProblem->value?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </div>
                    <div class="clear"></div>
                    <?php if(!empty($countsLimit['counts'])): ?>
                      <a href="#" class="dotted js-limit-devices-problems-table more" data-device-id="<?=$device->id?>" data-counts="<?=$countsLimit['counts']?>"  data-limit="<?=$countsLimit['limit']?>">Еще услуги</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }

}
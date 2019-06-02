<?php
namespace app\components;

use app\models\Functions;
use yii\base\Widget;
use Yii;

class WDevicesProblemsPriceList extends Widget{

    public $model;

    public function init() {
        parent::init();

        if ($this->model === null) {
            $this->model = false;
        }

    }
    public function run(){

        $request = Yii::$app->request;
        $id = abs($request->post('id') ? $request->post('id') : $this->model->devices[0]->id);
        $device_year_id = abs($request->post('device_year_id'));
        $diagonal_id = abs($request->post('diagonal_id'));

        $device = $this->model->getCurrentDevices(false,$id);
        $deviceYearOne = $device->getDeviceYearOne($device_year_id);
        $deviceDiagonalOne = !empty($deviceYearOne) ? $device->getDeviceDiagonalsOne($diagonal_id,$deviceYearOne->id) : false;
        if(empty($this->model->devices)) return 'Нет дивайс';


        //
        if(!empty($deviceYearOne)) {
            // Выгрузка с выбором фильтр;
            $diagonal_id = !empty($deviceDiagonalOne) ? $deviceDiagonalOne->id : false;
            $deviceProblems = $deviceYearOne->getDeviceProblems($diagonal_id,false);
        }else{
            // Выгрузка стандарт;
            $deviceProblems = $device->getDeviceProblems($device, false);
        }

        $deviceDiagonals =  !empty($deviceYearOne->deviceDiagonals) ? $deviceYearOne->deviceDiagonals : false;
        ?>

            <div class="devices-problems-list price-list">
                <div class="text-center title-main hidden"><h2>Выберите ваше устройство</h2></div>
                <div class="devices__menu devices_carusel desktop">
                    <div class="content__load"><div></div></div>
                    <div class="items">
                        <?php foreach ($this->model->devices as $key => $value): ?>
                            <div class="item <?=$device->id == $value->id ? 'active' : ''?>  js-select-devices" data-action="price-list"  data-id="<?=$value->id?>"><a href="#" style="height: auto"><?=$value->title?></a></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="select__mod mobile">
                    <select class="select js-select-devices" data-action="price-list">
                        <?php foreach ($this->model->devices as $key => $value): ?>
                           <option <?=$device->id == $value->id ? 'selected' : ''?> value="<?=$value->id?>" ><?=$value->title?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="block-table update_table_content">

                    <?php if(!empty($device->deviceYears) && count($device->deviceYears) != 1): ?>
                        <div class="devices__com list tags">
                            Выберите год выпуска:
                            <div class="items">
                                <?php foreach ($device->deviceYears as $deviceYear): ?>
                                    <div class="item js-device-tags  <?=($deviceYearOne->id == $deviceYear->id ? 'active' : '')?>  tags-1" data-index="1" data-id="<?=$device->id?>"  data-device-year-id="<?=$deviceYear->id?>"><a href="#"><?=$deviceYear->title?></a></div>
                                <?php endforeach; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php endif;?>

                    <?php if(!empty($device->deviceYearOne) && count($device->deviceYears) <= 1 || empty($deviceDiagonals)): ?>
                        <div class="info">
                            <?php if(!empty($deviceDiagonals)):?>
                                <div class="item">
                                    <div class="name">Год выпуска</div>
                                    <div class="name"><?=$deviceYearOne->title?></div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($deviceYearOne->title_th1) && !empty($deviceYearOne->value1)): ?>
                                <div class="item">
                                    <div class="name"><?=$deviceYearOne->title_th1?></div>
                                    <div class="name"><?=$deviceYearOne->value1?></div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($deviceYearOne->title_th2) && !empty($deviceYearOne->value2)): ?>
                                <div class="item">
                                    <div class="name"><?=$deviceYearOne->title_th2?></div>
                                    <div class="name"><?=$deviceYearOne->value2?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($deviceDiagonals)): ?>

                        <div class="devices__com list tags">
                            Выберите диагональ:
                            <div class="items">
                               <?php foreach ($deviceDiagonals as $deviceDiagonal): ?>
                                   <div class="item js-device-tags  <?=($deviceDiagonalOne->id == $deviceDiagonal->id ? 'active' : '')?> tags-2" data-index="2" data-id="<?=$device->id?>" data-device-year-id="<?=$deviceYearOne->id?>" data-diagonal-id="<?=$deviceDiagonal->id?>"  ><a href="#"><?=$deviceDiagonal->title?></a></div>
                               <?php endforeach; ?>
                            </div>
                            <div class="clear"></div>
                    </div>
                    <?php endif;?>

                       <div class="list-items">
                        <?php if(!empty($deviceProblems)): ?>
                            <?php foreach ($deviceProblems as $deviceProblem): ?>
                                <?php $style =  count($deviceProblems) >=1 ? 'style="width:100%"':'' ?>
                                <div class="list" <?=$style?>>
                                    <div class="content">
                                        <div class="name"><a href="/repair/<?=$device->menuRepair->url?>/<?=$device->url?>/<?=$deviceProblem->url?>"><?=$deviceProblem->title?></a></div>
                                        <div class="text-right value"><?=Functions::money($deviceProblem->price->money) > 0 ? Functions::money($deviceProblem->price->money).' р.' : 'Беслпатно' ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </div>


                </div>
            </div>
            <?php
        }

}
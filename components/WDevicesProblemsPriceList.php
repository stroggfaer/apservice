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
        $device = $this->model->getCurrentDevices(false,$id);

        if(empty($this->model->devices)) return 'Нет дивайс';
        $deviceProblems = $device->getDeviceProblems($device);

        ?>

            <div class="devices-problems-list">
                <div class="text-center title-main"><h2>Выберите ваше устройство</h2></div>
                <div class="devices__menu devices_carusel desktop">
                    <div class="content__load"><div></div></div>
                    <div class="items">
                        <?php foreach ($this->model->devices as $key => $value): ?>
                            <div class="item <?=$device->id == $value->id ? 'active' : ''?>  js-select-devices"  data-id="<?=$value->id?>"><a href="#" style="height: auto"><?=$value->title?></a></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="select__mod mobile">
                    <select class="select js-select-devices">
                        <?php foreach ($this->model->devices as $key => $value): ?>
                           <option <?=$device->id == $value->id ? 'selected' : ''?> value="<?=$value->id?>" ><?=$value->title?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="table update_table_content">
                    <table class="table">
                        <tr class="header">
                            <th class="name1">Услуги по ремонту <?=$device->title?></th>
                            <th class="text-right name2"></th>
                            <th class="text-right name3">Цена</th>
                        </tr>
                        <?php if(!empty($deviceProblems)): ?>
                            <?php foreach ($deviceProblems as $deviceProblem): ?>
                                <tr class="list">
                                    <td><a href="#"><?=$deviceProblem->title?></a></td>
                                    <td class="text-right"></td>
                                    <td class="text-right"><?=$deviceProblem->value?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
            <?php
        }

}
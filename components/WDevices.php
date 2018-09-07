<?php
namespace app\components;

use app\models\Clients;
use app\models\fitness\UserFitness;
use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use Yii;

class WDevices extends Widget{
    public $model;
    public $menu;
    public $one;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }

    }
    public function run(){
        if (empty($this->model->devices)) {
            return false;
        }else {


            ?>
              <?php if(empty($this->menu)): ?>
                 <div class="devices__com">
                <div class="items">
                   <?php foreach ($this->model->devices as $device): ?>
                       <?php $active = !empty($this->model->device) && $device->id == $this->model->device->id ? 'active': ''; ?>
                      <div class="item  <?=$active?>"><a href="/repair/<?=$device->menuRepair->url.'/'.$device->url?>"><?=$device->title?></a></div>
                   <?php endforeach; ?>
                </div>
                <div class="clear"></div>
            </div>
              <?php else: ?>
                 <div class="devices__menu devices_carusel desktop">
                    <div class="items">
                      <?php foreach ($this->model->devices as $device): ?>
                          <?php $active = !empty($this->model->device) && $device->id == $this->model->device->id ? 'active': ''?>
                          <div class="item  <?=$active?>"><a href="/repair/<?=$device->menuRepair->url.'/'.$device->url?>"><?=$device->title?></a></div>
                      <?php endforeach; ?>
                    </div>
                </div>
                 <div class="mobile">
                    <div class="select__mod">
                        <select class="select">
                          <?php foreach ($this->model->devices as $device): ?>
                              <?php $selected = !empty($this->model->device) && $device->id == $this->model->device->id ? 'selected': ''; ?>
                            <option <?=$selected?>><a href="/repair/<?=$device->menuRepair->url.'/'.$device->url?>"><?=$device->title?></a></option>
                          <?php endforeach; ?>
                        </select>
                    </div>
                </div>
              <?php endif; ?>
            <?php
        }
    }
}
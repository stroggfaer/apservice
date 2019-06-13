<?php
namespace app\components;
use yii\base\Widget;
use Yii;

class WDevices extends Widget{
    public $model;
    public $menu;
    public $one;
    public $level;


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

             <div class="devices__com ">
                <div class="desktop">
                    <div class="items">
                       <?php foreach ($this->model->devices as $device): ?>

                           <?php
                              if(!empty($this->level) && $this->level == 3) {
                                  $active = !empty($this->model->device) && $device->id == $this->one->device->id ? 'active' : '';
                              }else {
                                  $active = !empty($this->model->device) && $device->id == $this->model->device->id ? 'active' : '';
                              }
                           ?>

                          <div class="item  <?=$active?>"><a href="/repair/<?=$device->menuRepair->url.'/'.$device->url?>"><?=$device->title?></a></div>
                       <?php endforeach; ?>
                    </div>
                    <div class="clear"></div>
                </div>
               <div class="mobile">
                     <div class="select__mod">
                         <select class="select"  onchange="top.location=this.value">

                             <?php foreach ($this->model->devices as $device): ?>

                                 <?php
                                       if(!empty($this->level) && $this->level == 3) {
                                           $selected = !empty($this->model->device) && $device->id == $this->one->device->id ? 'selected' : '';
                                       }else{
                                           $selected = !empty($this->model->device) && $device->id == $this->model->device->id ? 'selected' : '';
                                       }
                                       $icon = !empty($device->menuRepair->icon) ? $device->menuRepair->icon : '';
                                 ?>
                                 <option <?=$selected?> value="/repair/<?=$device->menuRepair->url.'/'.$device->url?>">
                                     <div class="<?=$icon?>"></div><?=$device->title?>
                                 </option>
                             <?php endforeach; ?>
                         </select>
                     </div>
                 </div>
            </div>


            <?php
        }
    }
}
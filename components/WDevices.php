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
                      // print_arr($this->model->device);

                                  $active = !empty($this->model->device) && $device->id == $this->model->device->id ? 'active' : '';


                              if(!empty($device->deviceProblemsDefault->deviceProblems->url)) {
                                  $url = '/repair/' . $device->menuRepair->url . '/' . $device->url.'/'.$device->deviceProblemsDefault->deviceProblems->url;
                              }else {
                                  $url = '/repair/' . $device->menuRepair->url . '/' . $device->url;
                              }


                           ?>

                          <div class="item  <?=$active?>"><a href="<?=$url?>"><?=$device->title?></a></div>
                       <?php endforeach; ?>
                    </div>
                    <div class="clear"></div>
                </div>
               <div class="mobile">
                     <div class="select__mod">
                         <select class="select"  onchange="top.location=this.value">

                             <?php foreach ($this->model->devices as $device): ?>

                                 <?php

                                       $selected = !empty($this->model->device) && $device->id == $this->model->device->id ? 'selected' : '';

                                       $icon = !empty($device->menuRepair->icon) ? $device->menuRepair->icon : '';
                                       if(!empty($device->deviceProblemsDefault->deviceProblems->url)) {
                                          $url = '/repair/' . $device->menuRepair->url . '/' . $device->url.'/'.$device->deviceProblemsDefault->deviceProblems->url;
                                       }else {
                                          $url = '/repair/' . $device->menuRepair->url . '/' . $device->url;
                                       }
                                 ?>
                                 <option <?=$selected?> value="<?=$url?>">
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
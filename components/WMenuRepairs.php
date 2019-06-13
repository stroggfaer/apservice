<?php
namespace app\components;

use yii\base\Widget;
use Yii;

class WMenuRepairs extends Widget{

    public $model;
    public $classNames;
    public $select;
    public $level;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
    }
    public function run(){
        if (!$this->model) {
            return false;
        }else {
            $class = (!empty($this->classNames) ? $this->classNames : '');
            $select = !empty($this->select) ? 'display-select' : '';

            ?>
            <div class="menu__devices <?=$class?>">
                    <div class="items <?=$select?>">
                        <?php foreach ($this->model->menuRepairs as $key=>$value ): ?>
                            <?php $active = (!empty($this->model->currentRepair->id) && $this->model->currentRepair->id == $value->id ? 'active' : '') ?>
                            <div class="item <?=$active?>">
                                <?php
                                 // Многоуровневый меню;
                                 $url = !empty($this->model->currentRepair->id) && !empty($this->model->device->url) && $this->model->currentRepair->id == $value->id ?
                                     $value->url.'/'.$this->model->device->url : (!empty($this->level) && $this->level == 2 ?
                                         $value->url.'/'.$value->device->url : (!empty($this->level) && $this->level == 3 ?
                                             $value->url.'/'.$value->device->url.'/'.$value->device->deviceProblemDefault->url : $value->url));

                                ?>
                                <a href="/repair/<?=$url?>">
                                    <div class="icon-menu <?=$value->icon?>"></div>
                                    <div class="menu"><?=$value->title?></div>
                                </a>
                            </div>
                        <?php endforeach;  ?>

                    </div>
                    <?php if(!empty($select)): ?>
                        <div class="select__mod <?=$select?>">
                       <select class="select js-select-devices">
                           <?php $active = (!empty($this->model->currentRepair->id) && $this->model->currentRepair->id == $value->id ? 'selected' : '') ?>
                           <?php foreach ($this->model->menuRepairs as $key => $value): ?>
                               <option <?=$active?> value="<?=$value->id?>" ><?=$value->title?></option>
                           <?php endforeach; ?>
                       </select>
                   </div>
                    <?php endif; ?>
            </div>
            <?php
        }
    }
}
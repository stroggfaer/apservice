<?php
namespace app\components;

use yii\base\Widget;
use Yii;

class WMenuRepairs extends Widget{
    public $model;

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
            ?>
            <div class="menu__devices">
                <div class="items desktop">
                    <?php foreach ($this->model->menuRepairs as $key=>$value ): ?>
                        <?php $active = (!empty($this->model->currentRepair->id) && $this->model->currentRepair->id == $value->id ? 'active' : '') ?>
                        <div class="item <?=$active?>">
                            <a href="/repair/<?=$value->url?>">
                                <div class="icon-menu <?=$value->icon?>"></div>
                                <div class="menu"><?=$value->title?></div>
                            </a>
                        </div>
                    <?php endforeach;  ?>
                </div>
                <div class="mobile">
                    <div class="select__mod">
                        <select class="select" onchange="top.location=this.value">
                            <?php foreach ($this->model->menuRepairs as $key=>$value ): ?>
                                <?php $selected = (!empty($this->model->currentRepair->id) && $this->model->currentRepair->id == $value->id ? 'selected' : '') ?>
                                <option <?=$selected?> value="/repair/<?=$value->url?>"><?=$value->title?></option>
                            <?php endforeach;  ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
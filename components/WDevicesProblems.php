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

class WDevicesProblems extends Widget{
    public $model;
    public $one;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
        if ($this->one === null) {
            $this->one = false;
        }
    }
    public function run(){

        if (empty($this->model->devicesProblems) && empty($this->one)) {
            return false;
        }else {

            ?>
            <div class="devices__com">
                <?php

                if(!empty($this->model->devicesProblems)): ?>
                    <?php foreach ($this->model->devicesProblems as $devicesProblems):
                        $active = $this->one->id == $devicesProblems->id ? 'active': '';
                        ?>
                        <div class="item <?=$active?>">

                            <a href="<?=$this->model->getUrl($devicesProblems->url)?>">
                                <?=$devicesProblems->title?>
                            </a>
                            <div class="text-center"><?=$devicesProblems->value?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php
        }
    }
}
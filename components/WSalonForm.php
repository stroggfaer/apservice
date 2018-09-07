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

class WSalonForm extends Widget{
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
        if (!$this->model) {
            return false;
        }else {
            ?>
            <form class="form__mod js-salon-form" role="form">
                <div class="row">
                    <div class="form-group col-md-4  col-xs-4">
                        <label>Выбранно устройство:</label>
                        <select class="form-control" name="device">
                            <?php if(!empty($this->model->devices)): ?>
                                <?php foreach ($this->model->devices as $device): ?>
                                    <?php $selected = !empty($this->model->device->id) && $device->id == $this->model->device->id ? 'selected': ''; ?>
                                    <option value="<?=$device->id?>" <?=$selected?> ><?=$device->title?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4  col-xs-4">
                        <label>Выбранно проблему:</label>
                        <select class="form-control" name="devicesProblem">
                            <?php if(!empty($this->model->devicesProblems)): ?>
                                <?php foreach ($this->model->devicesProblems as $devicesProblems):
                                    $selected = $this->one->id == $devicesProblems->id ? 'selected': '';
                                    ?>
                                    <option value="<?=$devicesProblems->id?>" <?=$selected?>><?=$devicesProblems->title?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4  col-xs-4">
                        <label>Выберите район:</label>
                        <select class="form-control" name="region">
                            <option>---</option>
                            <?php if(!empty($this->model->appleServices)): ?>
                                <?php foreach ($this->model->regions as $region): ?>
                                    <?php $selected = $region->id == $this->model->regions[0]->id ? 'selected': ''; ?>
                                    <option value="<?=$region->id?>" <?=$selected?>><?=$region->title?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </form>
            <?php
        }
    }
}
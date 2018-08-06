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

class WDevicesProblemsGroups extends Widget{
    public $model;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
    }
    public function run(){
        if (empty($this->model->devicesProblemsGroups)) {
            return false;
        }else {


            ?>
            <div class="devices__com groups">
                <?php foreach ($this->model->devicesProblemsGroups as $devicesProblemsGroups): ?>
                    <div class="group">
                        <div class="name"><?=$devicesProblemsGroups->title?></div>
                        <?php if(!empty($devicesProblemsGroups)): ?>
                            <?php foreach ($devicesProblemsGroups->deviceProblems as $devicesProblems): ?>
                                <div class="item">
                                    <a href="<?=Yii::$app->request->url.$devicesProblems->url?>">
                                      <?=$devicesProblems->title?>
                                      <div class="small"><?=($devicesProblems->value ? $devicesProblems->price->value : '')?></div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }
}
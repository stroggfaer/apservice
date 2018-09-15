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

        if (empty($this->model->devicesProblems)) {
            return false;
        }else {

            ?>
            <?php if(!empty($this->model->devicesProblems)): ?>
               <div class="items">
                <?php foreach ($this->model->devicesProblems as $key => $devicesProblems):

                    $active = !empty($this->one) && $this->one->id == $devicesProblems->id ? 'active': '';

                    ?>
                      <div class="item <?=$active?>">
                         <a href="<?=$this->model->getUrl($devicesProblems->url)?>">
                             <?=$devicesProblems->title?>
                             <?php if(!empty($devicesProblems->value)): ?>
                                <div class="small"><?=$devicesProblems->value?></div>
                             <?php endif; ?>
                         </a>
                       </div>
                   <?php endforeach; ?>
               </div>
            <?php endif; ?>
            <?php
        }
    }
}
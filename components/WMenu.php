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

class WMenu extends Widget{
    public $model;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
    }
    public function run(){
        if (!$this->model && false) {
            return false;
        }else {
            ?>
            <div class="items">
                <div class="item active"><a href="#">Ремонт</a></div>
                <div class="item"><a href="#">Поддержка</a></div>
                <div class="item"><a href="#">Продукция</a></div>
                <div class="item"><a href="#">Аксессуары</a></div>
                <div class="item"><a href="#">Контакты</a></div>
            </div>
            <?php
        }
    }
}
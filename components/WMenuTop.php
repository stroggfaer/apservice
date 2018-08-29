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

class WMenuTop extends Widget{
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
            <div class="hidden-slide_menu-module">
                <div><a class="no_border" href="/informatsiya">Информация</a></div>
                <div><a class="no_border" href="/about">О компании</a></div>
                <div><a class="no_border" href="/news">Новости</a></div>
                <div><a class="no_border" href="/vakansii">Вакансии</a></div>
                <div><a class="no_border" href="http://appleservice.us/" target="_blank">Франчайзинг</a></div>
                <div><a class="no_border" href="https://apple.sc/corpotdel/">Организациям</a></div>
            </div>
            <?php
        }
    }
}
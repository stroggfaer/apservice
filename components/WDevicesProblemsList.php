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

class WDevicesProblemsList extends Widget{
    public $model;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
    }
    public function run(){

        if (empty($this->model->devicesProblems) && false) {
            return false;
        }else {

            ?>
            <div class="devices-problems-list">
                <div class="text-center title-main"><h2>Выберите ваше устройство</h2></div>
                <div class="devices__menu devices_carusel desktop">
                    <div class="items">
                        <div class="item"><a href="#">iPhone 6S Plus</a></div>
                        <div class="item"><a href="#">iPhone 6S Plus</a></div>
                        <div class="item"><a href="#">iPhone 6S Plus</a></div>
                        <div class="item"><a href="#">iPhone 6S Plus</a></div>
                        <div class="item"><a href="#">iPhone 6S Plus</a></div>
                        <div class="item"><a href="#">iPhone 6S Plus</a></div>
                        <div class="item"><a href="#">iPhone 6S Plus</a></div>
                        <div class="item"><a href="#">iPhone 6S Plus</a></div>
                        <div class="item"><a href="#">iPhone 6S Plus</a></div>
                        <div class="item"><a href="#">iPhone 6S Plus</a></div>
                        <div class="item"><a href="#">iPhone 6S Plus</a></div>
                        <div class="item"><a href="#">iPhone 6S Plus</a></div>
                    </div>
                </div>
                <div class="select__mod mobile">
                    <select class="select">
                        <option>Ремонт Phone</option>
                        <option>Ремонт Phone</option>
                        <option>Ремонт Phone</option>
                        <option>Ремонт Phone</option>
                        <option>Ремонт Phone</option>
                        <option>Ремонт Phone</option>
                        <option>Ремонт Phone</option>
                        <option>Ремонт Phone</option>
                    </select>
                </div>
                <div class="table">
                    <table class="table">
                        <tr>
                            <th class="name1">Услуги по ремонту iPhone 6S</th>
                            <th class="text-right name2">Цена выезде</th>
                            <th class="text-right name3">Цена в сервисных центрах</th>
                        </tr>
                        <tr>
                            <td><a href="#">Замена сеткла</a></td>
                            <td class="text-right">2 350 руб</td>
                            <td class="text-right">от 1350 руб</td>
                        </tr>
                        <tr>
                            <td><a href="#">Замена сеткла</a></td>
                            <td class="text-right">2 350 руб</td>
                            <td class="text-right">от 1350 руб</td>
                        </tr>
                        <tr>
                            <td><a href="#">Замена сеткла</a></td>
                            <td class="text-right">2 350 руб</td>
                            <td class="text-right">от 1350 руб</td>
                        </tr>
                        <tr>
                            <td><a href="#">Замена сеткла</a></td>
                            <td class="text-right">2 350 руб</td>
                            <td class="text-right">от 1350 руб</td>
                        </tr>
                        <tr>
                            <td><a href="#">Замена сеткла</a></td>
                            <td class="text-right">2 350 руб</td>
                            <td class="text-right">от 1350 руб</td>
                        </tr>

                    </table>
                    <a href="#" class="dotted">Еще услуги</a>
                </div>
            </div>
            <?php
        }
    }
}
<?php
namespace app\components;
use yii\base\Widget;
use yii\helpers\Html;
use Yii;
use app\models\Functions;

class WAppleServices extends Widget{
    public $model;
    public $appleServices;
    public $one;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
        if ($this->appleServices === null) {
            $this->appleServices = false;
        }
        if ($this->one === null) {
            $this->one = false;
        }
    }
    public function run(){

        if (!$this->model && !$this->appleServices && !$this->one) {
            ?>
            <div class="container size text-center">
                <div style="padding: 45px 0px 0"><b>Нет данных</b></div>
            </div>
            <?php
            return false;
        }else {

            if(!empty($this->appleServices)) {
                ?>
                <div class="container size">
                    <?php foreach ($this->appleServices as $appleServices): ?>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-3 col-xs-3 image">
                                    <a href="<?=(!empty($appleServices->value) ? $appleServices->value : '/services/'.$appleServices->url)?>" class="no_border"><img src="<?= $appleServices->img.'?'.time()?>"/></a>
                                </div>
                                <div class="col-md-5 col-xs-5 address-service">
                                    <div class="title"><?= $appleServices->title ?></div>
                                    <div class="address"><?= $appleServices->address ?></div>
                                    <div class="metro"><i class="icon-m"></i><?= $appleServices->metro ?></div>
                                    <div class="time"><?= $appleServices->time ?></div>
                                    <div class="phone"><?= !empty($appleServices->phone) ? $appleServices->phone : $appleServices->city->phone ?></div>
                                </div>
                                <div class="col-md-4 col-xs-4 block">
                                    <div class="total">
                                        <div class="problems"><?=$this->one->title?> на <?= $this->model->device->title ?></div>
                                        <div class="content">
                                            <div class="time"><i class="icon-clock"></i><?= $this->one->time ?></div>
                                            <div class="money"><i class="icon-wallet"></i><?= Functions::money(!empty($this->one->price->money) ? $this->one->price->money : 0) ?>
                                                руб.
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
                <?php
            }
        }
    }
}
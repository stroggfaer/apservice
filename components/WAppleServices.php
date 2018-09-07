<?php
namespace app\components;
use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class WAppleServices extends Widget{
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
        if (!$this->model && true) {
            ?>
            <div class="container size text-center">
                <div style="padding: 45px 0px 0"><b>Нет данных</b></div>
            </div>
            <?php
            return false;
        }else {


            ?>
            <div class="container size">
                <?php foreach ($this->model as $appleServices): ?>
                   <div class="item">
                    <div class="row">
                        <div class="col-md-3 col-xs-3 image">
                            <a href="#" class="no_border"><img src="<?=$appleServices->img?>" /></a>
                        </div>
                        <div class="col-md-5 col-xs-5 address-service">
                            <div class="title"><?=$appleServices->title?></div>
                            <div class="address"><?=$appleServices->address?></div>
                            <div class="metro"><?=$appleServices->metro?></div>
                            <div class="time"><?=$appleServices->time?></div>
                            <div class="phone"><?=!empty($appleServices->phone) ? $appleServices->phone : $appleServices->city->phone?></div>
                        </div>
                        <div class="col-md-4 col-xs-4 block">
                            <div class="total">
                                <div class="problems">Замена аккумулятра на iphone 5</div>
                                <div class="content">
                                    <div class="_icon-ap2 time">20 мин</div>
                                    <div class="_icon-ap2 money">1 800 руб.</div>
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
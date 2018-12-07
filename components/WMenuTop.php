<?php
namespace app\components;
use yii\base\Widget;
use yii\helpers\Html;
use Yii;
use app\models\Pages;

class WMenuTop extends Widget{
    public $model;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
    }
    public function run(){

            $header = Pages::menuPages(3);
            if(!empty($header)) {
                ?>
                <div class="hidden-slide_menu-module">
                    <?php foreach ($header as $key => $menu): ?>
                        <div><a class="no_border" href="<?= (!empty($menu->url) ? $menu->url : $menu->value)?>"><?= $menu->title ?></a></div>
                    <?php endforeach; ?>
                </div>
                <?php
            }
        }

}
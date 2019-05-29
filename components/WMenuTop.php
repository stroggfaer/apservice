<?php
namespace app\components;
use app\models\Repair;
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

             $menuFooter = Pages::menuPagesFooter();


            if(!empty($menuFooter)) {
                ?>
                   <?php foreach ($menuFooter as $key => $menu): ?>
                       <a class="item" href="<?= (!empty($menu->url) ? $menu->url : $menu->value)?>"><?= $menu->title ?></a>
                   <?php endforeach; ?>
                <?php
            }
        }

}
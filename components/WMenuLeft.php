<?php
namespace app\components;
use app\models\Repair;
use yii\base\Widget;
use yii\helpers\Html;
use Yii;
use app\models\Pages;

class WMenuLeft extends Widget{

    public function run(){

             $menuFooter = Pages::menuPagesFooter();


            if(!empty($menuFooter)) {
                ?>
                <div class="left-menu hidden-xs">
                   <?php foreach ($menuFooter as $key => $menu): ?>
                      <a href="<?= (!empty($menu->url) ? '/'.$menu->url : $menu->value)?>" class="item active"><?= $menu->title ?></a>
                   <?php endforeach; ?>
                </div>
                <?php
            }
        }

}
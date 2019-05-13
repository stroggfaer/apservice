<?php
namespace app\components;
use app\models\Pages;
use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class WMenuMobile extends Widget{

    public function run()
    {

        $header = Pages::menuPages();
        if (!empty($header)) {
            ?>
            <div class="menu-items">
                <?php foreach ($header as $key => $menu):?>
                    <?php if($menu->id == 1000): ?>
                        <div class="item <?=$key == 0 ? 'active' : ''?>" >
                            <?= $menu->title ?><i class="fa fa-down" aria-hidden="true"></i>
                            <div class="group">
                                <a class="i" href="#">Menu</a>
                                <a class="i" href="#">Menu</a>
                                <a class="i" href="#">Menu</a>
                                <a class="i" href="#">Menu</a>
                            </div>
                        </div>
                    <?php else: ?>
                       <a class="item " href="<?= $menu->value ?>"><?= $menu->title ?><i class="fa fa-down" aria-hidden="true"></i></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="menu-footer">
                <a class="item" href="#">Новости</a>
                <a class="item" href="#">Новости</a>
                <a class="item" href="#">Новости</a>
                <a class="item" href="#">Новости</a>
                <a class="item" href="#">Новости</a>
                <a class="item" href="#">Новости</a>
            </div>
            <?php
        }

    }
}
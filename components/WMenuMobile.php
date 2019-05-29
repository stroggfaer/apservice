<?php
namespace app\components;
use app\models\Pages;
use app\models\Repair;
use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class WMenuMobile extends Widget{

    /**
     * @return string|void
     * @throws \Exception
     */
    public function run()
    {

        $header = Pages::menuPages();
        $repair = new Repair();
        if (!empty($header)) {
            ?>
            <div class="menu-items">
                <?php foreach ($header as $key => $menu):?>
                    <?php if($menu->id == 1000): ?>
                        <div class="item js-toggle-menu" >
                            <?= $menu->title ?><i class="fa fa-down" aria-hidden="true"></i>
                           <?php if(!empty($repair->menuRepairs)): ?>
                            <div class="group">
                                <?php foreach($repair->menuRepairs as $menuRepair): ?>
                                   <a class="i font_light" href="/repair/<?=$menuRepair->url?>"><?=$menuRepair->title?></a>
                                <?php endforeach; ?>
                            </div>
                           <?php endif; ?>
                        </div>
                    <?php else: ?>
                       <a class="item " href="<?= !empty($menu->value) ? $menu->value : '/'.$menu->url?>"><?= $menu->title ?><i class="fa fa-down" aria-hidden="true"></i></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="menu-footer">
                <?= \app\components\WMenuTop::widget()?>
            </div>
            <?php
        }

    }
}
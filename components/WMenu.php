<?php
namespace app\components;
use app\models\Pages;
use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class WMenu extends Widget{
    public $model;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
    }
    public function run()
    {

        $header = Pages::menuPages();
        if (!empty($header)) {
            ?>
            <div class="items">
                <?php foreach ($header as $key => $menu): ?>
                    <?php $url = !empty($menu->value) ? $menu->value : '/'.$menu->url ?>
                    <a class="<?=$key == 0 ? 'active' : ''?>" href="<?=$url?>"><?= $menu->title ?></a>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }
}
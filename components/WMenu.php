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
                    <div class="item <?=$key == 0 ? 'active' : ''?>"><a href="<?= $menu->value ?>"><?= $menu->title ?></a></div>
                <?php endforeach; ?>
            </div>
            <?php
        }
    }
}
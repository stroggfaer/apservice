<?php
namespace app\components;

use yii\base\Widget;
use Yii;

class WTest extends Widget{
    public $model;

    public function init() {
        parent::init();
        if ($this->model === null) {
            $this->model = false;
        }
    }
    public function run(){
        if (!$this->model) {
            return false;
        }else {
            ?>
            <div class="items">
                Проверка...
            </div>
            <?php
        }
    }
}
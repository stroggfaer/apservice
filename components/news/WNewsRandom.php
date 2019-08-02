<?php
namespace app\components\news;

use app\models\Functions;
use yii\base\Widget;
use Yii;
use yii\helpers\StringHelper;

class WNewsRandom extends Widget{
    public $newsRandom;

    public function init() {
        parent::init();
        if ($this->newsRandom === null) {
            $this->newsRandom = false;
        }
    }


    public function run(){
        if(!$this->newsRandom )  return false;
        if(count($this->newsRandom) > 4) {
            ?>
            <div class="news__com">
                <div class="title-main">
                    <h2>Читайте также</h2><a class="text-reg" href="/news/">Посмотреть все новости</a>
                    <div class="clear"></div>
                </div>
                <div class="row equal">
                    <?php foreach ($this->newsRandom as $item): ?>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="block">
                                <div class="images">
                                    <a href="<?= $item->url ?>"><img class="size-2"
                                                                     src="<?= $item->getImages(true) ?>"/></a>
                                </div>
                                <div class="date"><?= Functions::dateFormat($item->date_create) ?></div>
                                <div class="title"><a href="<?= $item->url ?>" class="red-hover"><?= $item->title ?></a>
                                </div>
                                <div class="anons"><?= StringHelper::truncate($item->anons, 180) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }

    }
}
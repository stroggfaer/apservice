<?php
namespace app\components\news;

use app\models\Functions;
use yii\base\Widget;
use Yii;
use yii\helpers\StringHelper;
use yii\widgets\LinkPager;

class WNewsItem extends Widget{
    public $modelNews;

    public function init() {
        parent::init();
        if ($this->modelNews === null) {
            $this->modelNews = false;
        }
    }
    public function run(){
        if (!$this->modelNews && empty($this->modelNews->newsAll)) {
            return false;
        }else {
            ?>
            <div class="row equal">
               <?php foreach ($this->modelNews->newsAll as $item): ?>
                   <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="block">
                            <div class="images">
                                <a href="<?=$item->url?>"><img class="size-2" src="<?=$item->getImages(true)?>" /></a>
                            </div>
                            <div class="date"><?=Functions::dateFormat($item->date_create)?></div>
                            <div class="title"><a href="<?=$item->url?>" class="red-hover"><?=$item->title?></a></div>
                            <div class="anons"><?=StringHelper::truncate($item->anons,180)?></div>
                        </div>
                    </div>
               <?php endforeach; ?>
            </div>

            <?php
            $pages = $this->modelNews->pages;
            $links = $pages->getLinks();
            foreach ($pages->getLinks() as $rel => $href) {
                $pages->getLinks()[$rel] =  123;
            }
            print_arr($pages->getLinks());
            // отображаем постраничную разбивку
            echo LinkPager::widget([
                'pagination' => $pages,
                'registerLinkTags' => true

            ]);
            ?>
            <?php
        }
    }
}